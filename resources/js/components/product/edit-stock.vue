<template>
     <div>
      <div>
          <router-link to="/stock" class="btn btn-primary ms-4">Go Back </router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Update Stock</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form @submit.prevent="stockUpdate" enctype="multipart/form-data">
            <div class="row">
					  <div >
					    <label>Product Quantity</label>
                      <div class="input-group input-group-outline">
                         <input type="number" min="0" oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" v-model="form.product_quantity">
                      </div>
                      <small class="text-danger" v-if="errors.product_quantity">{{errors.product_quantity[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-3">
              <button type="submit" class="btn btn-primary btn-block">Update Stock</button>
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
         product_quantity: '' 
        
      },
      errors:{},
   
    }
  },
  created(){
  	let id = this.$route.params.id
  	axios.get('/api/product/'+id)
  	// .then(({data}) => (this.form = data))
  	.then(({data}) => (data.map(item=>this.form.product_quantity = item.product_quantity)))
  	.catch(error => console.log(error))
  },

  methods:{
    
  stockUpdate(){
  	  let id = this.$route.params.id
       axios.post('/api/stock/update/'+id,this.form)
       .then(() => {
        this.$router.push({ name: 'stock'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
     },
  } 


  }
   
</script>


<style type="text/css">
  
</style>