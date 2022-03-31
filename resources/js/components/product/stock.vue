<template>
   <div>
      <div>
          <router-link to="/store-product" class="btn btn-primary ms-4">Add product</router-link>
       </div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="text" v-model="searchTerm" class="form-control" placeholder="Stock Name">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Stocks</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Name</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Code</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Category</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Sub Category</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Status</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Quantity</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Actions</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="product in filterSearch" :key="product.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <!-- <div>
                            <img src="../../../../assets/img/placeholder.png" id="em_photo">
                          </div> -->
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{product.product_name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-sm font-weight-bold mb-0">{{product.product_code}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-sm font-weight-bold mb-0">{{product.category_name}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-sm font-weight-bold mb-0">{{product.sub_category_name}}</p>
                      </td>
                        <td v-if="product.product_quantity  >= 1 " class="align-middle text-center"><span class="badge bg-gradient-success">Available</span></td>
                        <td v-else class="align-middle text-center"><span class="badge bg-gradient-danger">Stock Out</span></td>
                      <td class="align-middle text-center">
                        <p class="text-sm font-weight-bold mb-0">{{product.product_quantity}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <router-link :to="{name: 'edit-stock', params:{id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
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
        products:[],
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
      return this.products.filter(product => {
         return product.product_name.match(this.searchTerm)
      }) 
      }
    },
 
  methods:{
    allProduct(){
      axios.get('/api/product/')
      .then(({data}) => (this.products = data))
      .catch()
    }   

  },
  created(){
    if(!User.loggedIn()){
        this.$router.push({name:'/'})
    }
    this.allProduct();
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>