<template>
    <div>
      <div>
          <router-link to="/store-blog" class="btn btn-primary ms-4">Add Blog</router-link>
       </div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="text" v-model="searchTerm" class="form-control" placeholder="Blog Name">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Blogs</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Blog Title</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Blog Category</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Image</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Description</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Status</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Actions</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="blog in filterSearch" :key="blog.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <!-- <div>
                            <img src="../../../../assets/img/placeholder.png" id="em_photo">
                          </div> -->
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{blog.blog_title}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{blog.blog_category_name}}</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">Image</p>
                      </td>
                      <td class="align-middle text-center text">
                        <p class="text-sm font-weight-bold mb-0 disc">{{blog.blog_description}}</p>
                      </td>
                      <td v-if="blog.blog_status == true" class="align-middle text-center"><span class="badge bg-gradient-success">ONLINE</span></td>
                      <td v-else class="align-middle text-center"><span class="badge bg-gradient-danger">OFFLINE</span></td>
                      <td class="align-middle text-center">
                        <router-link :to="{name: 'edit-blog', params:{id:blog.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <a @click="deleteBlog(blog.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
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
        blogs:[],
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
      return this.blogs.filter(blog => {
         return blog.blog_title.match(this.searchTerm)
      }) 
      }
    },
 
  methods:{
    allBlog(){
      axios.get('/api/blog/')
      .then(({data}) => (this.blogs = data))
      .catch((error) => console.log(error))
    },
  deleteBlog(id){
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
                axios.delete('/api/blog/'+id)
               .then(() => {
                this.blogs = this.blogs.filter(blog => {
                  return blog.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'blog'})
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
    this.allBlog();
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
  .disc {
     width: 100px;
     white-space: nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
}
</style>