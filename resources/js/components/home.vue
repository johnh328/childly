<template>
    <div>
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">inventory</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Products</p>
                <h4 class="mb-0">{{products}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask week</p> -->
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">group</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Customers</p>
                <h4 class="mb-0">{{customers}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than lask month</p> -->
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Total Blog Posts</p>
                <h4 class="mb-0">{{blogs}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <!-- <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than yesterday</p> -->
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">currency_rupee</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">Sales</p>
                <h4 class="mb-0">{{total_sales}}</h4>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <!-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p> -->
            </div>
          </div>
        </div>
      </div>
      
      <div class="row mb-4 mt-5">
        <div >
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-6 col-7">
                  <h6>Today Orders</h6>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Email</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2">Product Name</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Amount</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-10">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="order in filterSearch" :key="order.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{order.email}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm">{{order.product_name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-xs font-weight-bold"> {{order.total_price}} </span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <router-link :to="{name: 'view-order', params:{id:order.id}}" class="btn btn-sm btn-primary">View</router-link>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script type="text/javascript">
  export default {
    data(){
    return {
      products: 0,
      customers: 0,
      blogs: 0,
      today_order:null,
      total_sales:0,
      orders:[],
      searchTerm:''
    }
  },
  computed:{
      filterSearch(){
      return this.orders.filter(order => {
         return order.product_name.match(this.searchTerm)
      }) 
    }
  },
    created(){
      if(!User.loggedIn()){
        this.$router.push({name:'/'})
      }
      axios.get('/api/product/')
      .then(({data}) => (this.products = data.length))
      .catch(error => console.log("PRODUCT ERROR:",error))

      axios.get('/api/customer/')
      .then(({data}) => (this.customers = data.length))
      .catch(error => console.log("CUSTOMER ERROR:",error))

      axios.get('/api/blog/')
      .then(({data}) => {(this.blogs = data.length);})
      .catch(error => console.log("CUSTOMER ERROR:",error))

      axios.get('/api/total/sale/')
      .then(({data}) => (this.total_sales = data))
      .catch(error => console.log("CUSTOMER ERROR:",error))

      axios.get('/api/today/order/')
      .then(({data}) => (this.orders = data))
      .catch(error => console.log("ORDER ERROR:",error))

    },
  }
</script>

<style type="text/css">

</style>