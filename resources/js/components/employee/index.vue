<template>
<div>
      <div>
          <router-link to="/store-employee" class="btn btn-primary ms-4">Add Employee</router-link>
       </div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="email" v-model="searchTerm" class="form-control" placeholder="Email address">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Employees</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Name</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Email</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Phone</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Salary</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Joining Date</th>
                      <th class="text-center text-uppercase text-secondary text-sm font-weight-bolder">Actions</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="employee in filterSearch" :key="employee.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <!-- <div>
                            <img src="../../../../assets/img/placeholder.png" id="em_photo">
                          </div> -->
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{employee.name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{employee.email}}</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{employee.phone}}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <p class="text-sm font-weight-bold mb-0">{{employee.salary}}</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-sm font-weight-bold">{{employee.joining_date}}</span>
                      </td>
                      <td class="align-middle text-center">
                        <router-link :to="{name: 'edit-employee', params:{id:employee.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
                        <router-link :to="{name: 'pay-salary', params:{id:employee.id}}" class="btn btn-sm btn-success">Pay Salary</router-link>
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
      return{
        employees:[],
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
      return this.employees.filter(employee => {
         return employee.email.match(this.searchTerm)
      }) 
      }
    },
 
  methods:{
    allEmployee(){
      axios.get('/api/employee/')
      .then(({data}) => (this.employees = data))
      .catch()
    },
  deleteEmployee(id){
             Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.delete('/api/employee/'+id)
               .then(() => {
                this.employees = this.employees.filter(employee => {
                  return employee.id != id
                })
               })
               .catch(() => {
                this.$router.push({name: 'employee'})
               })
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })

  } 

  },
  created(){
    this.allEmployee();
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>