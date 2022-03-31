<template>
    <div>
      <div>
          <router-link to="/brand" class="btn btn-primary ms-4">All Brand</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Add Brand</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<!-- <h4 class="card-title">Baby Details</h4> -->
					<form @submit.prevent="brandInsert" enctype="multipart/form-data">
            <div class="row">
					  <div >
					    <label>Brand Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.brand_name">
                      </div>
                      <small class="text-danger" v-if="errors.brand_name">{{errors.brand_name[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary btn-block">Add Brand</button>
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
          brand_name:null,
        },
        errors:{}
      }
    },
    methods:{
        brandInsert(){
          axios.post('/api/brand',this.form)
          .then(() => {
            this.$router.push({name:'brand'})
            Notification.success()
          })
          .catch(error => this.errors = error.response.data.errors)
        }
    }
  }

</script>

<style type="text/css">

</style>