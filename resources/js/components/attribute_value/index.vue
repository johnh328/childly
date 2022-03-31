<template>
    <div>
      <div>
          <router-link :to="{name: 'store-attribute-value', params:{id:attribute_id}}" class="btn btn-primary ms-4">Add Attribute Value</router-link>
       </div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="text" v-model="searchTerm" class="form-control" placeholder="Attribute Name">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Attribute Name</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Attribute Name</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Actions</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="attributeValues in filterSearch" :key="attributeValues.id">
                      <td>
                        <div class="d-flex px-3 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{attributeValues.attribute_value}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <router-link :to="{name: 'edit-attribute-value', params:{id:attributeValues.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <a @click="deleteAttributeValue(attributeValues.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>                      </td>
                    </tr>
                  </tbody>
                </table>
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
        attributeValues:[],
        searchTerm:'',
        attribute_id:null,
      }  
    },
    computed:{
      filterSearch(){
        return this.attributeValues.filter(attributeValue => {
          return attributeValue.attribute_value.match(this.searchTerm)
        })
      }
    },
    methods:{
        allAttributeValues(){
          let id = this.$route.params.id;
          this.attribute_id = this.$route.params.id;
          axios.get('/api/attribute-value/'+id)
          .then(({data})=>{
            this.attributeValues = data;
            })
          .catch(error => {
            console.log(error);
            console.log("Index Attribute Value Error");
          })
        },
        deleteAttributeValue(id) {
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then(async (result) => {
                if (result.value) {
                  let res = await axios.delete('/api/attribute-value/'+id).catch(error => console.log("TEST: ",error.response.data));
                  if(res.status == 200){
                    this.attributeValues = this.attributeValues.filter((attributeValue) => {
                     return attributeValue.id != id})
                  }else{
                    console.log("SOMETHING WENT WRONG")
                  }
                  Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
               }
               })
    },
    },
    created(){
      this.allAttributeValues()
    }
  }

</script>

<style type="text/css">
    #em_photo{
    height: 40px;
    width: 40px;
    }
</style>