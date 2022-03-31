<template>
    <div>
      <div>
          <router-link to="/category" class="btn btn-primary ms-4">All Category</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Category Update</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<!-- <h4 class="card-title">Baby Details</h4> -->
					<form @submit.prevent="categoryUpdate" enctype="multipart/form-data">
            <div class="row">
					  <div >
					    <label>Category Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.category_name">
                      </div>
                      <small class="text-danger" v-if="errors.category_name">{{errors.category_name[0]}}</small>
					  </div>
            <div class="form-row">
              <div class="col-md-6 mt-4">
                <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                <small class="text-danger" v-if="errors.photo"> {{ errors.photo[0] }} </small>
             </div>
              <div class="col-md-6 mt-4">
              <img :src="form.photo" style="height: 40px; width: 40px;">
              </div>   
             </div>
					</div>
          <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary btn-block">Update Category</button>
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
    created(){
      if(!User.loggedIn()){
        this.$router.push({name:'/'})
      }
    },
    data(){
      return {
        form:{
          category_name:'',
          photo: null,
        },
        errors:{}
      }
    },
    created(){
        let id = this.$route.params.id
        axios.get('/api/category/'+id)
        .then(({data}) => (this.form = data))
        .catch(error => console.log('Edit ERROR: ',error))
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
      categoryUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/category/'+id,this.form)
          .then(() => {
            this.$router.push({name:'category'})
            Notification.success()
          })
          .catch(error => this.errors = error.response.data.errors)
        }
    }
  }

</script>

<style type="text/css">

</style>