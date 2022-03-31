<template>
    <div>
      <div>
          <router-link to="/blog-category" class="btn btn-primary ms-4">All Blog Category</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Blog Category Update</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form @submit.prevent="categoryUpdate" enctype="multipart/form-data">
            <div class="row">
					  <div >
					    <label>Blog Category Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.blog_category_name">
                      </div>
                      <small class="text-danger" v-if="errors.blog_category_name">{{errors.blog_category_name[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary btn-block">Update Blog Category</button>
            </div>
					</form>
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
        form:{
          blog_category_name:'',
        },
        errors:{}
      }
    },
    created(){
        if(!User.loggedIn()){
        this.$router.push({name:'/'})
        }
        let id = this.$route.params.id
        axios.get('/api/blog-category/'+id)
        .then(({data}) => (this.form = data))
        .catch(error => console.log('Edit ERROR: ',error))
    },
    methods:{
        categoryUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/blog-category/'+id,this.form)
          .then(() => {
            this.$router.push({name:'blog-category'})
            Notification.success()
          })
          .catch(error => this.errors = error.response.data.errors)
        }
    }
  }

</script>

<style type="text/css">

</style>