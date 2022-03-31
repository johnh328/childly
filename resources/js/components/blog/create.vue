<template>
    <div>
      <div>
          <router-link to="/blog" class="btn btn-primary ms-4">Back</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Add Blog</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form @submit.prevent="blogInsert" enctype="multipart/form-data">
            <div class="row">
					  <div class="col-md-6">
					    <label>Blog Title</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.blog_title">
                      </div>
                      <small class="text-danger" v-if="errors.blog_title">{{errors.blog_title[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label>Blog Category</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="form.blog_category_name" required aria-label="Select your option">
                            <option :value="blog_category.blog_category_name" :key="blog_category.id" v-for="blog_category in blog_categories">{{ blog_category.blog_category_name }}</option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.blog_category_name"> {{ errors.blog_category_name[0] }} </small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Blog Description</label>
                      <div class="input-group input-group-outline">
                         <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="form.blog_description"></textarea>
                      </div>
                      <small class="text-danger" v-if="errors.blog_description">{{errors.blog_description[0]}}</small>
					  </div>
            <div class="col-md-6">
					    <label for="formFileMultiple" class="form-label mt-5">Choose Blog Image</label>
                <div class="input-group input-group-outline">
                    <input class="form-control" type="file" id="formFile" @change="onFileSelected">
                </div>
                <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
					  </div>
					  <div class="mt-4">
                <div class="form-check form-switch">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Blog Status</label>
                  <input class="form-check-input mt-1" type="checkbox" id="flexSwitchCheckDefault" v-model="form.blog_status">
                </div>
					  </div>
					</div>
          <div class="form-group mt-4">
              <button type="submit" class="btn btn-primary btn-block">Add Blog</button>
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
        blog_title: null,
        blog_category_name: null,
        blog_image_url: "test",
        blog_description: null,
        photo: null,
        blog_status: false,
      },
      errors:{},
      blog_categories:{},
    }
  },

  methods:{
    onFileSelected(event){
     let file = event.target.files[0];
     if (file.size > 1048770) {
      Notification.image_validation()
     }else{
      let reader = new FileReader();
      reader.onload = event =>{
        this.form.photo = event.target.result
      };
      reader.readAsDataURL(file);
     }

    },
    blogInsert(){
       console.log(this.form);
       axios.post('/api/blog',this.form)
       .then(() => {
        this.$router.push({ name: 'blog'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  },
       created(){
      axios.get('/api/blog-category')
      .then(({data}) => (this.blog_categories = data))
      .catch(error => console.log("BLOG CATEGORY ERROR:",error))
      } 


  }
   
</script>


<style type="text/css">
  
</style>