<template>
    <div>
      <div>
          <router-link to="/store-attribute" class="btn btn-primary ms-4">Add Attribute</router-link>
       </div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="text" v-model="searchTerm" class="form-control" placeholder="Attribute name">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Attribute</h6>
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
                    <tr v-for="attribute in filterSearch" :key="attribute.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{attribute.attribute_name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <router-link :to="{name: 'edit-attribute', params:{id:attribute.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <a @click="deleteAttribute(attribute.id)" class="btn btn-sm btn-danger"><font attribute="#ffffff">Delete</font></a>
                        <router-link :to="{name: 'attribute-value', params:{id:attribute.id}}" class="btn btn-sm btn-success">Add Attribute Value</router-link>
                      </td>
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
    data(){
      return {
        attributes:[],
        searchTerm:'',
      }  
    },
    computed:{
      filterSearch(){
        return this.attributes.filter(attribute => {
          return attribute.attribute_name.match(this.searchTerm)
        })
      }
    },
    methods:{
        allAttribute(){
          axios.get('/api/attribute/')
          .then(({data})=>(this.attributes = data))
          .catch(error => {
            console.log(error);
            console.log("Index Attribute Error");
          })
        },
        deleteAttribute(id) {
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonAttribute: '#3085d6',
              cancelButtonAttribute: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then(async (result) => {
                if (result.value) {
                  let res = await axios.delete('/api/attribute/'+id).catch(error => console.log("TEST: ",error.response.data));
                  if(res.status == 200){
                    this.attributes = this.attributes.filter((attribute) => {
                     return attribute.id != id})
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
      if(!User.loggedIn()){
        this.$router.push({name:'/'})
      }
      this.allAttribute()
    }
  }

</script>

<style type="text/css">
    #em_photo{
    height: 40px;
    width: 40px;
    }
</style>