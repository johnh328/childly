<template>
    <div>
      <div>
          <router-link to="/color" class="btn btn-primary ms-4">All Color</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Color Update</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form @submit.prevent="colorUpdate" enctype="multipart/form-data">
            <div class="row">
					  <div class="col-md-6">
					    <label>Color Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.color_name">
                      </div>
                      <small class="text-danger" v-if="errors.color_name">{{errors.color_name[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label>Color Hex</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.color_hex">
                      </div>
                      <small class="text-danger" v-if="errors.color_hex">{{errors.color_hex[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary btn-block">Update Color</button>
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
          color_name:'',
          color_hex:''
        },
        errors:{}
      }
    },
    created(){
        let id = this.$route.params.id
        axios.get('/api/color/'+id)
        .then(({data}) => (this.form = data))
        .catch(error => console.log('Edit ERROR: ',error))
    },
    methods:{
        colorUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/color/'+id,this.form)
          .then(() => {
            this.$router.push({name:'color'})
            Notification.success()
          })
          .catch(error => this.errors = error.response.data.errors)
        }
    }
  }

</script>

<style type="text/css">

</style>