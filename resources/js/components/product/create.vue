<template>
 <div>
      <div>
          <router-link to="/product" class="btn btn-primary ms-4">All Product</router-link>
       </div>
    <div class="content container-fluid">
    <div class="text-center">
      <h1 class="h4 text-gray-900">Add Product</h1>
    </div>		
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<form @submit.prevent="productInsert" enctype="multipart/form-data">
            <div class="row">
            <h4>Product Information</h4>
					  <div class="col-md-6">
					    <label>Product Name</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.product_name">
                      </div>
                      <small class="text-danger" v-if="errors.product_name">{{errors.product_name[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label>Product Code</label>
                      <div class="input-group input-group-outline">
                         <input type="text" class="form-control" v-model="form.product_code">
                      </div>
                      <small class="text-danger" v-if="errors.product_code">{{errors.product_code[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Product Category</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="form.category_id" required aria-label="Select your option">
                            <option :value="category.id" :key="category.id" v-for="category in categories">{{ category.category_name }}</option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.category_id"> {{ errors.category_id[0] }} </small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Product Sub Category</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="form.sub_category_id" required aria-label="Select your option">
                            <option :value="sub_category.id" :key="sub_category.id" v-for="sub_category in sub_categories">{{ sub_category.sub_category_name }}</option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.sub_category_id"> {{ errors.sub_category_id[0] }} </small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Supplier</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="form.supplier_id" required aria-label="Select your option">
                            <option :value="supplier.id" :key="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.supplier"> {{ errors.supplier[0] }} </small>
					  </div>
					  <div class="col-md-6">
					    <label class="mt-3">Product Price</label>
                      <div class="input-group input-group-outline">
                         <input type="number" min="1" oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control" v-model="form.product_price" placeholder="Enter price more than selling price">
                      </div>
                      <small class="text-danger" v-if="errors.product_price">{{errors.product_price[0]}}</small>
					  </div>
            <div class="col-md-6">
					    <label class="mt-3">Selling Price</label>
                      <div class="input-group input-group-outline">
                         <input type="number" min="1" oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control" v-model="form.selling_price">
                      </div>
                      <small class="text-danger" v-if="errors.selling_price">{{errors.selling_price[0]}}</small>
					  </div>
            <div class="col-md-6">
					    <label class="mt-3">Product Quantity</label>
                      <div class="input-group input-group-outline">
                         <input type="number" min="1" oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control" v-model="form.product_quantity">
                      </div>
                      <small class="text-danger" v-if="errors.product_quantity">{{errors.product_quantity[0]}}</small>
					  </div>
            <div class="col-md-6">
					    <label class="mt-3">Brand</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="form.brand_name" aria-label="Select your option">
                            <option :value="brand.brand_name" :key="brand.id" v-for="brand in brands">{{ brand.brand_name }}</option>
                         </select>
                      </div>
                      <!-- <small class="text-danger" v-if="errors.brand_name"> {{ errors.brand_name[0] }} </small> -->
					  </div>
					</div>


            <div class="row mt-3">
            <h4>Shipping Configuration</h4>
					  <div>
                <div class="form-check form-switch">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Free Shipping</label>
                  <input class="form-check-input mt-1" type="checkbox" id="flexSwitchCheckDefault" v-model="form.free_shipping">
                </div>
                <small class="text-danger" v-if="errors.free_shipping ">{{errors.free_shipping[0]}}</small>
					  </div>
          	<div class="mb-4 w-50" v-if="!form.free_shipping">
					    <label>Delivery Charge</label>
                 <div class="input-group input-group-outline">
                <input type="number" :required="!form.free_shipping ? true : false" min="1" oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control" v-model="form.delivery_charge">
              </div>
              <!-- <small class="text-danger" v-if="errors.product_name">{{errors.product_name[0]}}</small> -->
					  </div>
					  <div>
                <div class="form-check form-switch">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Refundable</label>
                  <input class="form-check-input mt-1" type="checkbox" id="flexSwitchCheckDefault" v-model="form.refundable">
                </div>
              <div class="mb-4 w-50" v-if="form.refundable">
					     <label>Refund Date in days</label>
                 <div class="input-group input-group-outline">
                <input type="number" :required="form.refundable ? true : false" min="1" oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control" v-model="form.refundable_day">
               </div>
              <!-- <small class="text-danger" v-if="errors.product_name">{{errors.product_name[0]}}</small> -->
					     </div>
					  </div>
					  <div class="col-md-6">
                <div class="form-check form-switch">
                  <label class="form-check-label" for="flexSwitchCheckDefault">Cash On Delivery</label>
                  <input class="form-check-input mt-1" type="checkbox" id="flexSwitchCheckDefault" v-model="form.cash_on_delivery">
                </div>
                <!-- <small class="text-danger" v-if="errors.cash_on_delivery">{{errors.cash_on_delivery[0]}}</small> -->
					  </div>
					</div>

          <div class="row mt-3">
            <h4>Product Images</h4>
					  <div class="col-md-6">
					    <label for="formFileMultiple" class="form-label">Choose Thumbnail Images</label>
                      <div class="input-group input-group-outline">
                         <input class="form-control" required type="file" id="formFile" @change="onFileSelected">
                      </div>
                      <small class="text-danger" v-if="errors.thumbnail_image">{{errors.thumbnail_image[0]}}</small>
					  </div>
					  <div class="col-md-6">
					    <label for="formFileMultiple" class="form-label">Choose Product Images</label>
                      <div class="input-group input-group-outline">
                         <input class="form-control" required type="file" id="formFileMultiple" multiple @change="onMultiFileSelected">
                      </div>
                      <small class="text-danger" v-if="errors.photos">{{errors.photos[0]}}</small>
					  </div>
					</div> 

          <div class="row mt-4">
            <h4>Product Variation</h4>
					  <div class="col-md-6">
					    <label >Colors</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" multiple v-model="form.product_color" aria-label="Select your option">
                            <option :value="product_color1.color_name" :key="product_color1.id" v-for="product_color1 in product_colors">{{ product_color1.color_name }}</option>
                         </select>
                      </div>
                      <!-- <small class="text-danger" v-if="errors.product_color"> {{ errors.product_color[0] }} </small> -->
					  </div>
					  <div class="col-md-6">
					    <label >Attribute</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="form.attribute_name" @change='getAttributeValue()' aria-label="Select your option">
                            <option :value="product_attribute1.attribute_name" :key="product_attribute1.id" v-for="product_attribute1 in product_attributes">{{ product_attribute1.attribute_name }}</option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.product_attribute"> {{ errors.product_attribute[0] }} </small>
					  </div>
					  <div class="col-md-6 mt-3">
					    <label >Attribute Value</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" multiple v-model="form.product_attribute_value"  aria-label="Select your option">
                            <option :value="product_attribute_value.attribute_value" :key="product_attribute_value.id" v-for="product_attribute_value in product_attribute_values">{{ product_attribute_value.attribute_value }}</option>
                         </select>
                      </div>
              <small class="text-danger" v-if="errors.product_attribute_value"> {{ errors.product_attribute_value[0] }} </small>
					  </div>
					  <div class="col-md-6 mt-3" v-if="form.refundable">
					    <label>Return Detail</label>
                    <div class="input-group input-group-outline">
                         <textarea class="form-control" :required="form.refundable ? true : false" id="exampleFormControlTextarea1" rows="3" v-model="form.return_detail"></textarea>
                    </div>
                <small class="text-danger" v-if="errors.return_detail"> {{ errors.return_detail[0] }} </small>
					  </div>
					</div>

          <div class="row mt-4">
            <h4>Product Description</h4>
					  <div class="col-md-6">
					    <label >Description</label>
                    <div class="input-group input-group-outline">
                         <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" v-model="form.product_description"></textarea>
                    </div>
              <small class="text-danger" v-if="errors.product_description">{{errors.product_description[0]}}</small>
					  </div>
            <h4 class="mt-4">More Info</h4>
					  <div class="col-md-6">
					    <label >Detail Information</label>
                    <div class="input-group input-group-outline">
                         <textarea class="form-control" id="exampleFormControlTextarea3" rows="8" v-model="form.product_more_info"></textarea>
                    </div>
              <small class="text-danger" v-if="errors.product_more_info">{{errors.product_more_info[0]}}</small>
					  </div>
					</div>
          <div class="form-group mt-5">
              <button type="submit" class="btn btn-primary btn-block">Add Product</button>
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
        product_name: null,
        brand_name: '',
        product_code: null,
        category_id: null,
        sub_category_id: null,
        supplier_id: null,
        product_price: null,
        selling_price: null,
        free_shipping: false,
        refundable: false,
        refundable_day: null,
        cash_on_delivery: false,
        product_description: null,
        product_more_info: null,
        thumbnail_image: null,
        product_images: null,
        product_quantity: null,
        product_attribute:null,
        product_attribute_value:[],
        product_color:[],
        photos:null,
        return_detail:null,
        delivery_charge:null,
        attribute_name:'',
      },
      errors:{},
      categories:{},
      brands:{},
      product_colors:{},
      product_attributes:{},
      product_attribute_values:{},
      sub_categories:{},
      suppliers:{},
    }
  },

  methods:{

    productInsert(){
      console.log(this.form);
       axios.post('/api/product',this.form)
       .then(() => {
        this.$router.push({ name: 'product'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       .catch(error =>console.log(error.response.data.errors))
     },
     getAttributeValue(){
        axios.get('/api/attribute-value/by-name/'+this.form.attribute_name)
        .then(({data}) => (this.product_attribute_values = data))
        .catch(error => console.log("ATTRIBUTE VALUE ERROR:",error))
     },
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

    toBase64(file) {
      return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => resolve(reader.result);
      reader.onerror = error => reject(error);
     });
    },

     async toBase64Handler(filesLists) {
      const filePathsPromises = [];
      for(let i = 0; i < filesLists.length; i++){filePathsPromises.push(this.toBase64(filesLists[i]));}
      const filePaths = await Promise.all(filePathsPromises);
      const mappedFiles = filePaths.map((base64File) => (base64File));
      this.form.photos = mappedFiles;
    },

    onMultiFileSelected(event){
     let files = event.target.files;
     this.toBase64Handler(files);
    },
  },

  created(){
    if(!User.loggedIn()){
        this.$router.push({name:'/'})
    }
    axios.get('/api/category/')
    .then(({data}) => (this.categories = data))
    .catch(error => console.log("CATEGORY ERROR:",error))

    axios.get('/api/supplier/')
    .then(({data}) => (this.suppliers = data))
    .catch(error => console.log("SUPPLIER ERROR:",error))

    axios.get('/api/sub-category/')
    .then(({data}) => (this.sub_categories = data))
    .catch(error => console.log("SUB CATEGORY ERROR:",error))

    axios.get('/api/color/')
    .then(({data}) => (this.product_colors = data))
    .catch(error => console.log("SUB COLOR ERROR:",error))

    axios.get('/api/brand/')
    .then(({data}) => (this.brands = data))
    .catch(error => console.log("SUB COLOR ERROR:",error))

    axios.get('/api/attribute/')
    .then(({data}) => (this.product_attributes = data))
    .catch(error => console.log("ATTRIBUTE ERROR:",error))

  } 


  }

   
</script>


<style type="text/css">

</style>