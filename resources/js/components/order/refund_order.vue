<template>
  <div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="text" v-model="searchTerm" class="form-control" placeholder="Enter Name">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Today Orders</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Customer Name</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Product Name</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Total Amount</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Payment Mode</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Tracking Status</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Action</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="order in filterSearch" :key="order.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{order.name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{order.product_name}}</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{order.total_price}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-sm font-weight-bold mb-0">{{order.payment_mode}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-sm font-weight-bold">{{order.tracking_status}}</span>
                      </td>
                      <td class="align-middle text-center">
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
      return{
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
 
  methods:{


  },
  created(){
    axios.get('/api/refund/order/')
    .then(({data}) => (this.orders = data))
    .catch(error => console.log("ORDER ERROR:",error))
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>