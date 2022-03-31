<template>
    <div>
      <div>
          <router-link to="/customer" class="btn btn-primary ms-4">All Customer</router-link>
       </div>
    <div class="content container-fluid">		
    <div class="text-center">
      <h1 class="h4 text-gray-900">Customer Update</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<h4 class="card-title">Basic Info</h4>
					<form @submit.prevent="customerUpdate" enctype="multipart/form-data">
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
                          <select class="select form-control" v-model="form.parent">
                         <option>Mom</option>
                         <option>Dad</option>
                         <option>Guardian</option>
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
					<!-- BILLING ADDRESS -->
					<h4 class="card-title mt-4">Billing Address</h4>
                    <div class="row">
					  <div class="col-md-6">
					    <label>Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.billing_name">
                      </div>
                      <small class="text-danger" v-if="errors.billing_name">{{errors.billing_name[0]}}</small>

					  <label class="mt-3">State</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.billing_state">
                      </div>
                      <small class="text-danger" v-if="errors.billing_state">{{errors.billing_state[0]}}</small>
					  <label class="mt-3">Billing Address</label>
                      <div class="input-group input-group-outline">
                         <textarea rows="3" cols="5" class="form-control" v-model="form.billing_address"></textarea>
                      </div>
                      <small class="text-danger" v-if="errors.billing_address">{{errors.billing_address[0]}}</small>
					  </div>
					  
					  <div class="col-md-6">
					    <label>Country</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.billing_country">
                      </div>
                      <small class="text-danger" v-if="errors.billing_country">{{errors.billing_country[0]}}</small>

					  <label class="mt-3">City</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.billing_city">
                      </div>
                      <small class="text-danger" v-if="errors.billing_city">{{errors.billing_city[0]}}</small>
					  <label class="mt-3">Phone</label>
                      <div class="input-group input-group-outline">
                         <input type="tel" class="form-control" v-model="form.billing_phone">
                      </div>
                      <small class="text-danger" v-if="errors.billing_phone">{{errors.billing_phone[0]}}</small>
					  <label class="mt-3">Zip Code</label>
                      <div class="input-group input-group-outline">
                         <input type="tel" class="form-control" v-model="form.billing_zip_code">
                      </div>
                      <small class="text-danger" v-if="errors.billing_zip_code">{{errors.billing_zip_code[0]}}</small>
					  </div>
					</div>
                     <a @click="copyAddress" class="btn btn-primary btn-block">Copy Billing Address</a>
					<!-- SHIPPING ADDRESS -->
					<h4 class="card-title mt-4">Shipping Address</h4>
                    <div class="row">
					  <div class="col-md-6">
					    <label>Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.shipping_name">
                      </div>
                      <small class="text-danger" v-if="errors.shipping_name">{{errors.shipping_name[0]}}</small>

					  <label class="mt-3">State</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.shipping_state">
                      </div>
                      <small class="text-danger" v-if="errors.shipping_state">{{errors.shipping_state[0]}}</small>
					  <label class="mt-3">Shipping Address</label>
                      <div class="input-group input-group-outline">
                         <textarea rows="3" cols="5" class="form-control" v-model="form.shipping_address"></textarea>
                      </div>
                      <small class="text-danger" v-if="errors.shipping_address">{{errors.shipping_address[0]}}</small>
					  </div>
					  
					  <div class="col-md-6">
					    <label>Country</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.shipping_country">
                      </div>
                      <small class="text-danger" v-if="errors.shipping_country">{{errors.shipping_country[0]}}</small>

					  <label class="mt-3">City</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.shipping_city">
                      </div>
                      <small class="text-danger" v-if="errors.shipping_city">{{errors.shipping_city[0]}}</small>
					  <label class="mt-3">Phone</label>
                      <div class="input-group input-group-outline">
                         <input type="tel" class="form-control" v-model="form.shipping_phone">
                      </div>
                      <small class="text-danger" v-if="errors.shipping_phone">{{errors.shipping_phone[0]}}</small>
					  <label class="mt-3">Zip Code</label>
                      <div class="input-group input-group-outline">
                         <input type="tel" class="form-control" v-model="form.shipping_zip_code">
                      </div>
                      <small class="text-danger" v-if="errors.shipping_zip_code">{{errors.shipping_zip_code[0]}}</small>
					  </div>
					</div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Update Customer</button>
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
          newPhoto:null,
        },
        errors:{}
      }
    },
    created(){
        if(!User.loggedIn()){
        this.$router.push({name:'/'})
        }
        let id = this.$route.params.id
        axios.get('/api/customer/'+id)
        .then(({data}) => (this.form = data))
        .catch(error => console.log('Edit ERROR: ',error.response.data.errors))
    },
    methods:{
        onFileSelected(event){
          let file = event.target.files[0];
          if(file.size > 1048770){
            Notification.image_validation()
          }else{
            let reader = new FileReader();
            reader.onload = event => {
              this.form.newPhoto = event.target.result
            };
            reader.readAsDataURL(file);
          }
        },
        customerUpdate(){
          let id = this.$route.params.id
          axios.patch('/api/customer/'+id,this.form)
          .then(() => {
            this.$router.push({name:'customer'})
            Notification.success()
          })
          .catch(error => {
            console.log("CUSTOMER UPDATE ERROR:",error);
            this.errors = error.response.data.errors
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