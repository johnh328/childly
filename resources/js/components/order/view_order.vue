<template>
  <div>
       <div>
          <router-link to="/order" class="btn btn-primary ms-4">Go Back</router-link>
       </div>
    <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"> Order Details </h1>
                  </div>
          <div class="row">
            <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Order Details </h6>
                </div>
                <div class="table-responsive">        
                  <ul class="list-group">
                    <li class="list-group-item"><b>Customer Name :</b> {{ orders.name }} </li>
                    <li class="list-group-item"><b>Phone :</b> {{ orders.phone }}</li>
                    <li class="list-group-item"><b>Date :</b> {{ orders.created_at }}</li>
                    <li class="list-group-item"><b>Pay Through :</b> {{ orders.payment_mode }}</li>
                    <li class="list-group-item"><b>Total Price :</b> {{ orders.total_price }}</li>
                    <li class="list-group-item"><b>Tracking Status :</b> {{ orders.tracking_status }}</li>
                    <div class="row" v-if="orders.is_cancelled == 'false'">
                    <div class="col-md-6 px-4">
					           <label >Attribute</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="tracking_status" required aria-label="Select your option">
                            <option>Ordered</option>
                            <option>Shipping</option>
                            <option>Out for delivery</option>
                            <option>Delivered</option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.tracking_status"> {{ errors.tracking_status[0] }} </small>
					         </div>
                      <div class="form-group mt-3 px-4">
                       <a @click="orderUpdate(orders.id)" class="btn btn-primary">Update Status</a>
                       <a @click="deleteOrder(orders.id)" class="btn btn-danger"><font color="#ffffff">Cancel</font></a>
                      </div>
                    </div>
                    <div class="row" v-if="orders.tracking_status === 'Refund' || orders.is_cancelled == 'false'">
                    <div class="col-md-6 px-4">
					           <label >Attribute</label>
                      <div class="input-group input-group-outline">
                         <select class="form-control" v-model="tracking_status" required aria-label="Select your option">
                            <option>Returned</option>
                         </select>
                      </div>
                      <small class="text-danger" v-if="errors.tracking_status"> {{ errors.tracking_status[0] }} </small>
					         </div>
                      <div class="form-group mt-3 px-4">
                       <a @click="refundUpdate(orders.id)" class="btn btn-primary">Update Status</a>
                       <a @click="deleteOrder(orders.id)" class="btn btn-danger"><font color="#ffffff">Cancel</font></a>
                      </div>
                    </div>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-6 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Address Details</h6>
                </div>
                <div class="table-responsive">
                  <ul class="list-group">
                    <li class="list-group-item"><b>Name :</b> {{ address.name }}</li>
                    <li class="list-group-item"><b>Country :</b> {{ address.country }}</li>
                    <li class="list-group-item"><b>State :</b> {{ address.state }}</li>
                    <li class="list-group-item"><b>City :</b> {{ address.city }}</li>
                    <li class="list-group-item"><b>Phone :</b> {{ address.phone }}</li>
                    <li class="list-group-item"><b>Zip Code :</b> {{ address.zip_code }}</li>
                    <li class="list-group-item"><b>Address :</b> {{ address.address }} </li>
                    <li class="list-group-item"><b>Place :</b> {{ address.is_home }} </li>
                  </ul>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th class="text-uppercase text-center text-sm font-weight-bolder">Product Name</th>
                        <th class="text-uppercase text-center text-sm font-weight-bolder">Product Code</th>
                        <th class="text-uppercase text-center text-sm font-weight-bolder">Image</th>
                        <th class="text-uppercase text-center text-sm font-weight-bolder">Color</th>
                        <th class="text-uppercase text-center text-sm font-weight-bolder">Attribute</th>
                        <th class="text-uppercase text-center text-sm font-weight-bolder">Qty</th>
                        <th class="text-uppercase text-center text-sm font-weight-bolder">Unit Price</th>
                        <th class="text-uppercase text-center text-sm font-weight-bolder">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="align-middle text-center">{{ orders.product_name }}</td>
                        <td class="align-middle text-center">{{ orders.product_code }}</td>
                        <td class="align-middle text-center"><img :src="orders.product_thumbnail" id="em_photo"></td>
                        <td class="align-middle text-center">{{ orders.product_color }}</td>
                        <td class="align-middle text-center">{{ orders.product_attribute_value }}</td>
                        <td class="align-middle text-center">{{ orders.product_amount }}</td>
                        <td class="align-middle text-center">{{ orders.product_price }}</td>
                        <td class="align-middle text-center">{{ orders.total_price }}</td>
                      </tr>
                       
                    </tbody>
                  </table>
                </div>
              </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



<script type="text/javascript">

  import moment from 'moment';
  
  export default {    
    data(){
    return {
      errors:{},
      orders:{},
      details:{},
      address:[],
      tracking_status:null,
    }
  },
  created(){
    if(!User.loggedIn()){
        this.$router.push({name:'/'})
    }
  	let id = this.$route.params.id
  	axios.get('/api/order/by-id/'+id)
  	.then(({data}) => {
      this.orders = data[0]
      this.orders.created_at = this.format_date(this.orders.created_at);
      this.address = JSON.parse(this.orders.address)[0];
      })
  	.catch((error) => console.log(error))
  },

  methods:{
    orderUpdate(id){
       axios.patch('/api/order/'+id,{
          "is_cancelled":"false",
          "tracking_status":this.tracking_status,
       })
       .then(() => {
        this.$router.push({ name: 'order'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       .catch(error =>console.log(error.response.data.errors))
     },
    refundUpdate(id){
       axios.patch('/api/order/'+id,{
          "is_cancelled":"true",
          "tracking_status":this.tracking_status,
       })
       .then(() => {
        this.$router.push({ name: 'order'})
        Notification.success()
       })
       .catch(error =>this.errors = error.response.data.errors)
       .catch(error =>console.log(error.response.data.errors))
     },
    format_date(value){
         if (value) {
           return moment(String(value)).format('MM/DD/YYYY')
          }
      },
    deleteOrder(id) {
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Cancel it!'
            }).then(async (result) => {
                if (result.value) {
                  let res = await axios.patch('/api/order/'+id,{
                    "is_cancelled":"true",
                    "tracking_status":"Cancelled",
                  })
                  .catch(error => console.log("ORDER: ",error.response.data));
                  if(res.status == 200){
                    this.$router.push({ name: 'order'})
                  }else{
                    console.log("SOMETHING WENT WRONG")
                  }
                  Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
            )
          }
        }
      )
    },
  } 


  }
   
</script>


<style type="text/css">
   #em_photo{
    height: 40px;
    width: 40px;
  }
</style>