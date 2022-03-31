<template>
    <div>
      <!-- <div>
          <router-link to="/store-customer" class="btn btn-primary ms-4">Add Customer</router-link>
       </div> -->
       <br>
          <!-- <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search here"> -->
          <div class="input-group input-group-outline mx-3">
          <input type="email" v-model="searchTerm" class="form-control" placeholder="Email address">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Customers</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Name</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Email</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Phone</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Registered On</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Actions</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="customer in filterSearch" :key="customer.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <!-- <div>
                            <img src="../../../../assets/img/placeholder.png" id="em_photo">
                          </div> -->
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{customer.name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{customer.email}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-sm font-weight-bold mb-0">{{customer.email}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-sm font-weight-bold">{{customer.register_on}}</span>
                      </td>
                      <td class="align-middle text-center">
                        <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
                        <router-link :to="{name: 'baby', params:{id:customer.id}}" class="btn btn-sm btn-success">Add Babies</router-link>
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
        customers:[],
        searchTerm:'',
      }  
    },
    computed:{
      filterSearch(){
        return this.customers.filter(customer => {
          return customer.email.match(this.searchTerm)
        })
      }
    },
    methods:{
        allCustomer(){
          axios.get('/api/customer/')
          .then(({data})=>(this.customers = data))
          .catch(error => {
            console.log(error);
            console.log("Index Customer Error");
          })
        },
        deleteCustomer(id) {
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then(async (result) => {
                if (result.value) {
                  let res = await axios.delete('/api/customer/'+id).catch(error => console.log("TEST: ",error.response.data));
                  if(res.status == 200){
                    this.customers = this.customers.filter((customer) => {
                     return customer.id != id})
                  }else{
                    console.log("SOMETHING WENT WRONG")
                  }
                  Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
               }
               })
    },
    },
    created(){
      if(!User.loggedIn()){
        this.$router.push({name:'/'})
      }
      this.allCustomer()
    }
  }

</script>

<style type="text/css">
    #em_photo{
    height: 40px;
    width: 40px;
    }
</style>