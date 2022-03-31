<template>
    <div>
      <div>
          <router-link :to="{name: 'sub-category', params:{id:form.sub_category_id}}" class="btn btn-primary ms-4">Back</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Update Sub Category</h1>
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
              <button type="submit" class="btn btn-primary btn-block">Update Sub Category</button>
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
          sub_category_name:null,
          sub_category_id:null,
        },
        errors:{}
      }
    },
    created(){
      let id = this.$route.params.id
      axios.get('/api/show-sub-category/'+id)
      .then(({data}) => {
        this.form.sub_category_id = data.id;
        this.form.sub_category_name = data.sub_category_name;
      })
      .catch(error => console.log('Edit ERROR: ',error))
    },
    methods:{
        subCategoryInsert(){
          let id = this.$route.params.id
          axios.patch('/api/sub-category/'+id,this.form)
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