<template>
    <div>
      <div>
          <router-link to="/store-category" class="btn btn-primary ms-4">Add Category</router-link>
       </div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="text" v-model="searchTerm" class="form-control" placeholder="Category name">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Category</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Image</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Category Name</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Actions</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="category in filterSearch" :key="category.id">
                      <td class="align-middle text-center">
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <img :src="category.image_url" id="em_photo">
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{category.category_name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <router-link :to="{name: 'edit-category', params:{id:category.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <a @click="deleteCategory(category.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
                        <router-link :to="{name: 'sub-category', params:{id:category.id}}" class="btn btn-sm btn-success">Add Sub Categories</router-link>
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
    created(){
      if(!User.loggedIn()){
        this.$router.push({name:'/'})
      }
    },
    data(){
      return {
        categories:[],
        searchTerm:'',
      }  
    },
    computed:{
      filterSearch(){
        return this.categories.filter(category => {
          return category.category_name.match(this.searchTerm)
        })
      }
    },
    methods:{
        allCategory(){
          axios.get('/api/category/')
          .then(({data})=>(this.categories = data))
          .catch(error => {
            console.log(error);
            console.log("Index Category Error");
          })
        },
        deleteCategory(id) {
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
                  let res = await axios.delete('/api/category/'+id).catch(error => console.log("TEST: ",error.response.data));
                  if(res.status == 200){
                    this.categories = this.categories.filter((category) => {
                     return category.id != id})
                  }else{
                    console.log("SOMETHING WENT WRONG")
                  }
                  Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
              )
            }
           }
          )
         },
    },
    created(){
      this.allCategory()
    }
  }

</script>

<style type="text/css">
    #em_photo{
    height: 100px;
    width: 100px;
    }
</style>