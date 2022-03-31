<template>
    <div>
      <div>
          <router-link :to="{name: 'attribute-value', params:{id:form.attribute_id}}" class="btn btn-primary ms-4">Back</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Add Attribute Value of {{form.attribute_name}}</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<!-- <h4 class="card-title">Baby Details</h4> -->
					<form @submit.prevent="attributeValueInsert" enctype="multipart/form-data">
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
              <button type="submit" class="btn btn-primary btn-block">Add Attribute Value</button>
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
          attribute_value:null,
          attribute_id:null,
          attribute_name:null,
        },
        errors:{}
      }
    },
    created(){
      let id = this.$route.params.id
      this.form.attribute_id = this.$route.params.id;
      axios.get('/api/attribute/'+id)
      .then(({data}) => {
        this.form.attribute_name = data.attribute_name;
      })
      .catch(error => console.log('Edit ERROR: ',error))
    },
    methods:{
        attributeValueInsert(){
          axios.post('/api/attribute-value',this.form)
          .then(() => {
            this.$router.push({name:'attribute-value'})
            Notification.success()
          })
          .catch(error => this.errors = error.response.data.errors)
        }
    }
  }

</script>

<style type="text/css">

</style>