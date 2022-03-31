<template>
    <div class="page-header align-items-start min-vh-100 px-0" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Sign up</h4>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" @submit.prevent="signup">
                  <label>Name</label>
                  <div class="input-group input-group-outline mb-3">
                    <input type="text" class="form-control" v-model="form.name">
                  </div>
                  <label>Email</label>
                  <div class="input-group input-group-outline mb-3">
                    <input type="email" class="form-control" v-model="form.email">
                  </div>
                  <small class="text-danger" v-if="errors.email">{{errors.email[0]}}</small>
                  <div>
                    <label>Password</label>
                  <div class="input-group input-group-outline">
                    <input type="password" class="form-control" v-model="form.password">
                  </div>
                    <small class="text-danger" v-if="errors.password">{{errors.password[0]}}</small>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Sign up</button>
                  </div>
                  <p class="mt-4 text-sm text-center">
                    Already have an account?
                    <router-link to="/" class="text-primary text-gradient font-weight-bold">Sign in</router-link>
                  </p>
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
      if(User.loggedIn()){
        this.$router.push({name:'home'})
      }
    },
    data(){
      return {
        form:{
          name:'admin',
          email:'admin@gmail.com',
          password:'admin123'
        },
        errors:{}
      }
    },
    methods:{
        signup(){
         axios.post('/api/auth/signup',this.form)
        .then(res => {
          console.log(res);
          User.responseAfterLogin(res)
          Toast.fire({
            icon: 'success',
            title: 'Sign up successfully'})
          this.$router.push({name:'home'})
        })
        .catch((error) =>
         {
          Toast.fire({
          icon: 'warning',
          title: 'Only one admin is allowed.'
          },);
           this.errors = error.response.data.errors;
           console.log(error);
         }
         );
      }
    }
  }

</script>

<style type="text/css">

</style>