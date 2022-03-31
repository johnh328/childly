<template>
    <div>
      <div>
          <router-link to="/given-salary" class="btn btn-primary ms-4">Pay Salary</router-link>
       </div>
       <br>
          <div class="input-group input-group-outline mx-3">
          <input type="text" v-model="searchTerm" class="form-control" placeholder="Salary month">
          </div>
       <br>
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">All Salary Details</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder">Month Name</th>
                      <th class="text-uppercase text-secondary text-sm font-weight-bolder ps-2">Details</th>
                      <th class="text-secondary"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="salary in filterSearch" :key="salary.id">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-md">{{salary.salary_month}}</h6>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center">
                        <router-link :to="{name: 'view-salary', params:{id:salary.salary_month}}" class="btn btn-sm btn-primary">View Salary</router-link>
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
        salaries:[],
        searchTerm:''
      }
    },
    computed:{
      filterSearch(){
      return this.salaries.filter(salary => {
         return salary.salary_month.match(this.searchTerm)
      }) 
      }
    },
 
  methods:{
    allSalary(){
      axios.get('/api/salary/')
      .then(({data}) => (this.salaries = data))
      .catch()
    },
    
  },
  created(){
    this.allSalary();
  } 
  

  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>