<template>
    <div>
      <div>
          <router-link to="/attribute" class="btn btn-primary ms-4">All Attribute</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Attribute Update</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form @submit.prevent="attributeUpdate" enctype="multipart/form-data">
            <div class="row">
					  <div class="col-md-6">
					    <label>Attribute Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.attribute_name">
                      </div>
                      <small class="text-danger" v-if="errors.attribute_name">{{errors.attribute_name[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary btn-block">Update Attribute</button>
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
          attribute_name:''
        },
        errors:{}
      }
    },
    created(){
        let id = this.$route.params.id
        axios.get('/api/attribute/'+id)
        .then(({data}) => (this.form = data))
        .catch(error => console.log('Edit ERROR: ',error))
    },
    methods:{
        attributeUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/attribute/'+id,this.form)
          .then(() => {
            this.$router.push({name:'attribute'})
            Notification.success()
          })
          .catch(error => this.errors = error.response.data.errors)
        }
    }
  }

</script>

<style type="text/css">

</style>