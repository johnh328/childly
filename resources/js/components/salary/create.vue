<template>
    <div>
       <div>
          <router-link to="/employee" class="btn btn-primary">All Employee </router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Pay Salary</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form @submit.prevent="salaryPaid" enctype="multipart/form-data">
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
					    <label class="mt-3">Months</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="form.salary_month" required aria-label="Select your option">
                               <option value="January"> January </option>
                               <option value="February"> February </option>
                               <option value="March"> March </option>
                               <option value="April"> April </option>
                               <option value="May"> May </option>
                               <option value="Jun"> Jun </option>
                               <option value="July"> July </option>
                               <option value="August"> August </option>
                               <option value="September"> September </option>
                               <option value="October"> October </option>
                               <option value="November"> November </option>
                               <option value="December"> December </option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.salary_month"> {{ errors.salary_month[0] }} </small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Salary</label>
                      <div class="input-group input-group-outline">
                         <input type="number" min="1" oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control" v-model="form.salary">
                      </div>
                      <small class="text-danger" v-if="errors.salary">{{errors.salary[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-5">
              <button type="submit" class="btn btn-primary btn-block">Pay now</button>
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
        name: '',
        email: '',
        salary_month: '',
        salary: ''
       
      },
      errors:{}
    }
  },
  created(){
  	let id = this.$route.params.id
  	axios.get('/api/employee/'+id)
  	.then(({data}) => (this.form = data))
  	.catch((error) => console.log("Edit Salary: ",error))
  },

  methods:{
   
  salaryPaid(){
  	  let id = this.$route.params.id
       axios.post('/api/salary/paid/'+id,this.form)
       .then((res) => {
        if(res.data == 'Salary Already Paid'){
            Toast.fire({
            icon: "error",
            title: "Salary Already Paid",
        });
        this.$router.push({ name: 'given-salary'})
        }else{
          this.$router.push({ name: 'given-salary'})
          Notification.success()
        }
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  } 


  }
   
</script>


<style type="text/css">
  
</style>