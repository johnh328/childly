<template>
    <div>
      <div>
          <!-- <router-link to="/baby" class="btn btn-primary ms-4">Back</router-link> -->
          <router-link :to="{name: 'baby', params:{id:form.customer_id}}" class="btn btn-primary ms-4">Back</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Add Baby of {{form.parent_name}}</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<h4 class="card-title">Baby Details</h4>
					<form @submit.prevent="babyInsert" enctype="multipart/form-data">
            <div class="row">
					  <div class="col-md-6">
					    <label>Baby Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.baby_name">
                      </div>
                      <small class="text-danger" v-if="errors.baby_name">{{errors.baby_name[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label>Gender</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="form.gender" required aria-label="Select your option">
                          <option value="" disabled selected>Select your option</option>
                          <option value="Boy">Boy</option>
                          <option value="Girl">Girl</option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.gender">{{errors.gender[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">DOB</label>
                      <div class="input-group input-group-outline">
                         <input type="date" class="form-control" v-model="form.dob">
                      </div>
                      <small class="text-danger" v-if="errors.dob">{{errors.dob[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-5">
              <button type="submit" class="btn btn-primary btn-block">Add Baby</button>
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
          baby_name:null,
          customer_id:null,
          parent_name:null,
          gender:null,
          dob:null,
          image_url:'test',
        },
        errors:{},
      }
    },
    created(){
      if(!User.loggedIn()){
        this.$router.push({name:'/'})
      }
      let id = this.$route.params.id
      axios.get('/api/customer/'+id)
      .then(({data}) => {
        this.form.customer_id = data.id;
        this.form.parent_name = data.name;
      })
      .catch(error => console.log('Edit ERROR: ',error))
    },
    methods:{
        babyInsert(){
          axios.post('/api/baby',this.form)
          .then(() => {
            this.$router.push({name:'baby'})
            Notification.success()
          })
          .catch((error) => {
            this.errors = error.response.data.errors
            console.log(error);
            console.log("Create Baby Error");
            })
        },
    }
  }

</script>

<style type="text/css">

</style>