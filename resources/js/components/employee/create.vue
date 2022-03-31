<template>
     <div>
      <div>
          <router-link to="/employee" class="btn btn-primary ms-4">All Employee </router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Add Employee</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<h4 class="card-title">Employee Details</h4>
					<form @submit.prevent="employeeInsert" enctype="multipart/form-data">
            <div class="row">
					  <div class="col-md-6">
					    <label>Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.name">
                      </div>
                      <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label>Email</label>
                      <div class="input-group input-group-outline">
                         <input type="email" class="form-control" v-model="form.email">
                      </div>
                      <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Address</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.address">
                      </div>
                      <small class="text-danger" v-if="errors.address">{{errors.address[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Salary</label>
                      <div class="input-group input-group-outline">
                         <input type="number" min="1" oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control" v-model="form.salary">
                      </div>
                      <small class="text-danger" v-if="errors.salary">{{errors.salary[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Nid</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.nid">
                      </div>
                      <small class="text-danger" v-if="errors.nid">{{errors.nid[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Phone</label>
                      <div class="input-group input-group-outline">
                         <input type="number" min="1" oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control" v-model="form.phone">
                      </div>
                      <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
					  </div>
            <div class="col-md-6">
					    <label class="mt-3">Joining Date</label>
                      <div class="input-group input-group-outline">
                         <input type="date" class="form-control" v-model="form.joining_date">
                      </div>
                      <small class="text-danger" v-if="errors.joining_date">{{errors.joining_date[0]}}</small>
					  </div>
            <div class="col-md-6">
					    <label for="formFileMultiple" class="form-label  mt-3">Choose Employee photo</label>
                <div class="input-group input-group-outline">
                  <input class="form-control" required type="file" id="formFile" @change="onFileSelected">
                </div>
              <small class="text-danger" v-if="errors.photo">{{errors.photo[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-5">
              <button type="submit" class="btn btn-primary btn-block">Add Employee</button>
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
        name: null,
        email: null,
        phone: null,
        salary: null,
        address: null,
        photo: null,
        nid: null,
        joining_date: null
      },
      errors:{}
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
  employeeInsert(){
       axios.post('/api/employee',this.form)
       .then(() => {
        this.$router.push({ name: 'employee'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  } 


  }
   
</script>


<style type="text/css">
  
</style>