<template>
    <div>
      <div>
          <router-link to="/store-supplier" class="btn btn-primary ms-4">Add Supplier</router-link>
       </div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="text" v-model="searchTerm" class="form-control" placeholder="Supplier Name">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Suppliers</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Name</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Photo</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Phone</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Shop Name</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Email</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Actions</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="supplier in filterSearch" :key="supplier.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{supplier.name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <img :src="supplier.photo" id="em_photo">
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{supplier.phone}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-sm font-weight-bold mb-0">{{supplier.shop_name}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-sm font-weight-bold">{{supplier.email}}</span>
                      </td>
                      <td class="align-middle text-center">
                        <router-link :to="{name: 'edit-supplier', params:{id:supplier.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <a @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
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
        suppliers:[],
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
      return this.suppliers.filter(supplier => {
         return supplier.name.match(this.searchTerm)
      }) 
      }
    },
 
  methods:{
    allSupplier(){
      axios.get('/api/supplier/')
      .then(({data}) => (this.suppliers = data))
      .catch((error) => console.log(error))
    },
  deleteSupplier(id){
             Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.delete('/api/supplier/'+id)
               .then(() => {
                this.suppliers = this.suppliers.filter(supplier => {
                  return supplier.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'supplier'})
               })
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })

  } 

  },
  created(){
    if(!User.loggedIn()){
        this.$router.push({name:'/'})
    }
    this.allSupplier();
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>