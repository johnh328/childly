<template>
    <div>
      <div>
          <router-link :to="{name: 'sub-category', params:{id:form.category_id}}" class="btn btn-primary ms-4">Back</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Add Sub Category of {{form.category_name}}</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<!-- <h4 class="card-title">Baby Details</h4> -->
					<form @submit.prevent="subCategoryInsert" enctype="multipart/form-data">
            <div class="row">
					  <div >
					    <label>Sub Category Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.sub_category_name">
                      </div>
                      <small class="text-danger" v-if="errors.sub_category_name">{{errors.sub_category_name[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary btn-block">Add Sub Category</button>
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
          sub_category_name:null,
          category_id:null,
          category_name:null,
        },
        errors:{}
      }
    },
    created(){
      if(!User.loggedIn()){
        this.$router.push({name:'/'})
      }
      let id = this.$route.params.id
      this.form.category_id = this.$route.params.id;
      axios.get('/api/category/'+id)
      .then(({data}) => {
        // this.form.category_id = data.id;
        this.form.category_name = data.category_name;
      })
      .catch(error => console.log('Edit ERROR: ',error))
    },
    methods:{
        subCategoryInsert(){
          axios.post('/api/sub-category',this.form)
          .then(() => {
            this.$router.push({name:'sub-category'})
            Notification.success()
          })
          .catch(error => this.errors = error.response.data.errors)
        }
    }
  }

</script>

<style type="text/css">

</style>