<template>
    <div>
      <div>
          <router-link :to="{name: 'attribute-value', params:{id:form.attribute_id}}" class="btn btn-primary ms-4">Back</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Update Attribute Value</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<!-- <h4 class="card-title">Baby Details</h4> -->
					<form @submit.prevent="attributeValueUpdate" enctype="multipart/form-data">
            <div class="row">
					  <div >
					    <label>Attribute Value</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.attribute_value">
                      </div>
                      <small class="text-danger" v-if="errors.attribute_value">{{errors.attribute_value[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary btn-block">Update Attribute Value</button>
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
          attribute_value:null,
          attribute_id:null,
        },
        errors:{}
      }
    },
    created(){
      if(!User.loggedIn()){
        this.$router.push({name:'/'})
      }
      let id = this.$route.params.id
      axios.get('/api/attribute/attribute-value/'+id)
      .then(({data}) => {
        this.form.attribute_id = data.attribute_id;
        this.form.attribute_value = data.attribute_value;
      })
      .catch(error => console.log('Edit ERROR: ',error))
    },
    methods:{
        attributeValueUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/attribute-value/'+id,this.form)
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