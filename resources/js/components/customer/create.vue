<template>
    <div>
      <div>
          <router-link to="/customer" class="btn btn-primary ms-4">All Customer</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Add Customer</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<h4 class="card-title">Basic Info</h4>
					<form @submit.prevent="customerInsert" enctype="multipart/form-data">
                    <div class="row">
					  <div class="col-md-6">
					    <label>Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.name">
                      </div>
                      <small class="text-danger" v-if="errors.name">{{errors.name[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label>Parent / Guardian </label>
                      <div class="input-group input-group-outline">
                        <select class="form-control" v-model="form.parent">
                         <option value="Mom">Mom</option>
                         <option value="Dad">Dad</option>
                         <option value="Guardian">Guardian</option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.parent">{{errors.parent[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Email</label>
                      <div class="input-group input-group-outline">
                         <input type="email" class="form-control" v-model="form.email">
                      </div>
                      <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Phone</label>
                      <div class="input-group input-group-outline">
                         <input type="tel" class="form-control" v-model="form.phone">
                      </div>
                      <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
					  </div>
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
          name:null,
          email:null,
          phone:null,
          photo:null,
          parent:null,
          billing_name:null,
          billing_country:null,
          billing_state:null,
          billing_city:null,
          billing_address:null,
          billing_phone:null,
          billing_zip_code:null,
          shipping_name:null,
          shipping_country:null,
          shipping_state:null,
          shipping_city:null,
          shipping_address:null,
          shipping_phone:null,
          shipping_zip_code:null,
          
        },
        errors:{},
      }
    },
    methods:{
        onFileSelected(event){
          let file = event.target.files[0];
          if(file.size > 1048770){
            Notification.image_validation()
          }else{
            let reader = new FileReader();
            reader.onload = event => {
              this.form.photo = event.target.result
            };
            reader.readAsDataURL(file);
          }
        },
        customerInsert(){
          axios.post('/api/customer',this.form)
          .then(() => {
            this.$router.push({name:'customer'})
            Notification.success()
          })
          .catch((error) => {
            this.errors = error.response.data.errors
            console.log(error.response.data.errors);
            console.log("Create Customer Error");
            })
        },
      copyAddress() {
        this.form.shipping_name = this.form.billing_name
        this.form.shipping_country = this.form.billing_country
        this.form.shipping_state = this.form.billing_state
        this.form.shipping_city = this.form.billing_city
        this.form.shipping_address = this.form.billing_address
        this.form.shipping_phone = this.form.billing_phone
        this.form.shipping_zip_code = this.form.billing_zip_code
    },
    }
  }

</script>

<style type="text/css">

</style>