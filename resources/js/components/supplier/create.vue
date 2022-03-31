<template>
    <div>
      <div>
          <router-link to="/supplier" class="btn btn-primary ms-4">Back</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Add Supplier</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form @submit.prevent="supplierInsert" enctype="multipart/form-data">
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
					    <label class="mt-3">Shop Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.shop_name">
                      </div>
                      <small class="text-danger" v-if="errors.shop_name">{{errors.shop_name[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Phone Number</label>
                      <div class="input-group input-group-outline">
                         <input type="number" min="1" oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control" v-model="form.phone">
                      </div>
                      <small class="text-danger" v-if="errors.phone">{{errors.phone[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-5">
              <button type="submit" class="btn btn-primary btn-block">Add Supplier</button>
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
        name: null,
        email: null,
        phone: null,
        shop_name: null,
        address: null,
        photo: null
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
        console.log(event.target.result);
      };
      reader.readAsDataURL(file);
     }

    },
  supplierInsert(){
       axios.post('/api/supplier',this.form)
       .then(() => {
        this.$router.push({ name: 'supplier'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  } 


  }
   
</script>


<style type="text/css">
  
</style>