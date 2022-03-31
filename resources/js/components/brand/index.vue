<template>
    <div>
      <div>
          <router-link to="/store-brand" class="btn btn-primary ms-4">Add Brand</router-link>
       </div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="text" v-model="searchTerm" class="form-control" placeholder="Brand name">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Brand</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Brand Name</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Actions</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="brand in filterSearch" :key="brand.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <!-- <div>
                            <img src="../../../../assets/img/placeholder.png" id="em_photo">
                          </div> -->
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{brand.brand_name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <router-link :to="{name: 'edit-brand', params:{id:brand.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <a @click="deleteBrand(brand.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
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
        brands:[],
        searchTerm:'',
      }  
    },
    computed:{
      filterSearch(){
        return this.brands.filter(brand => {
          return brand.brand_name.match(this.searchTerm)
        })
      }
    },
    methods:{
        allBrand(){
          axios.get('/api/brand/')
          .then(({data})=>(this.brands = data))
          .catch(error => {
            console.log(error);
            console.log("Index Brand Error");
          })
        },
        deleteBrand(id) {
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
                  let res = await axios.delete('/api/brand/'+id).catch(error => console.log("TEST: ",error.response.data));
                  if(res.status == 200){
                    this.brands = this.brands.filter((brand) => {
                     return brand.id != id})
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
      this.allBrand()
    }
  }

</script>

<style type="text/css">
    #em_photo{
    height: 40px;
    width: 40px;
    }
</style>