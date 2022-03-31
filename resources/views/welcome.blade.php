<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Childly
  </title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="./assets/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
  <div id="app">
  <aside  id="sidenav-main" :class="[$route.path !== '/' ? 'sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark' : '']" style="display: none;" v-show="$route.path === '/' ? false : true">
    <div class="sidenav-header" style=" height: 2.5rem;">
        <h6 class="align-middle text-center font-weight-bold text-white mt-3">Childly</h6>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link class="nav-link text-white" active-class="active" to="/home">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-white " active-class="active" to="/customer">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">group</i>
            </div>
            <span class="nav-link-text ms-1">Customers</span>
          </router-link>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#categoryToggle" class="nav-link text-white collapsed" aria-controls="categoryToggle" role="button" aria-expanded="false">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">blur_circular</i>
            </div>
            <span class="nav-link-text ms-1">Categories</span>
          </a>
          <div class="collapse" id="categoryToggle">
            <ul>
              <li class="nav-item"class="nav-item"><router-link class="dropdown-item" active-class="active" to="/category">Category</router-link></li>
              <li class="nav-item"class="nav-item"><router-link class="dropdown-item" active-class="active" to="/sub-category">Sub Category</router-link></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-white " active-class="active" to="/employee">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Employees</span>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link text-white " active-class="active" to="/salary">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">attach_money</i>
            </div>
            <span class="nav-link-text ms-1">Salary</span>
          </router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link text-white " active-class="active" to="/supplier">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">local_shipping</i>
            </div>
            <span class="nav-link-text ms-1">Suppliers</span>
          </router-link>
        </li> 
      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#productToggle" class="nav-link text-white collapsed" aria-controls="productToggle" role="button" aria-expanded="false">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">local_parking</i>
          </div>
          <span class="nav-link-text ms-1">Products</span>
        </a>
        <div class="collapse" id="productToggle">
          <ul>
            <li class="nav-item"class="nav-item"><router-link class="dropdown-item" active-class="active" to="/product">Product</router-link></li>
            <li class="nav-item"><router-link class="dropdown-item" active-class="active" to="/brand">Brand</router-link></li>
            <li class="nav-item"><router-link class="dropdown-item" active-class="active" to="/attribute">Atrribute</router-link></li>
            <li class="nav-item"><router-link class="dropdown-item" active-class="active" to="/color">Color</router-link></li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#blogToggle" class="nav-link text-white collapsed" aria-controls="blogToggle" role="button" aria-expanded="false">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">collections</i>
          </div>
          <span class="nav-link-text ms-1">Blogs</span>
        </a>
        <div class="collapse" id="blogToggle">
          <ul>
            <li class="nav-item">
              <router-link class="dropdown-item" active-class="active" to="/blog">All Blogs</router-link>
            </li>
            <li class="nav-item">
              <router-link class="dropdown-item" active-class="active" to="/blog-category">Blog Category</router-link>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a data-bs-toggle="collapse" href="#orderToggle" class="nav-link text-white collapsed" aria-controls="orderToggle" role="button" aria-expanded="false">
          <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="material-icons opacity-10">local_mall</i>
          </div>
          <span class="nav-link-text ms-1">Orders</span>
        </a>
        <div class="collapse" id="orderToggle">
          <ul>
            <li class="nav-item">
              <router-link class="dropdown-item" active-class="active" to="/order">Orders</router-link>
            </li>
            <li class="nav-item">
              <router-link class="dropdown-item" active-class="active" to="/refund">Refunds</router-link>
            </li>
          </ul>
        </div>
      </li>
        <li class="nav-item">
          <router-link class="nav-link text-white " active-class="active" to="/stock">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">local_grocery_store</i>
            </div>
            <span class="nav-link-text ms-1">Stocks</span>
          </router-link>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true" style="display: none;" v-show="$route.path === '/' || $route.path === '/register' || 
    $route.path === '/forget' ? false : true">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <router-link to="/logout" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">Logout</span>
              </router-link>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
           
          </ul>
        </div>
      </div>
    </nav>
  {{-- </nav> --}}
    <!-- End Navbar -->
    {{-- vue --}}
    <div>
       <router-view></router-view>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script src="{{asset('js/app.js')}}"></script>
  <script src="./assets/js/material-dashboard.min.js?v=3.0.0"></script>
  <style type="text/css">
     .navbar-vertical .navbar-nav > .nav-item .nav-link.active{
       background-image: linear-gradient(195deg, #EC407A 0%, #D81B60 100%)
     }
     .nav-item > a:hover, .nav-item > a:focus {
      color: #fff;
      background-image: linear-gradient(195deg, #EC407A 0%, #D81B60 100%)
     }
     .vue{
      position: absolute;
      left: 0;
      right: 0;
     }
  </style>
</body>

</html>