<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kasir</title>
  <!-- base:css -->
  <link rel="stylesheet" href="{{asset('kasir/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('kasir/vendors/base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('kasir/css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('kasir/images/favicon.png')}}" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:kasir/partials/_horizontal-navbar.html -->

    <div class="horizontal-menu sticky">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
              <li class="nav-item nav-search d-none d-lg-block ml-3">
                <h3 class="text-dark">Nama Perusahaan</h3>
              </li>
            </ul>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="kasir/index.html"><h1>Logo</h1></a>
            </div>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown  d-lg-flex d-none">
                  <button type="button" class="btn btn-inverse-primary btn-sm">Product </button>
                </li>
                <li class="nav-item dropdown d-lg-flex d-none">
                  <button type="button" class="btn btn-inverse-primary btn-sm">Settings</button>
                </li>
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">Johnson</span>
                    <span class="online-status"></span>
                    <img src="{{asset('kasir/images/faces/face28.png')}}" alt="profile"/>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                      <a class="dropdown-item" onclick="return confirm('Are you sure?')" href="{{url('logout')}}">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>
      <nav class="bottom-navbar bg-info">
        <div class="container">
            <ul class="nav page-navigation">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">
                  <i class="mdi mdi-file-document-box menu-icon"></i>
                  <span class="menu-title">Pembayaran</span>
                </a>
              </li>
              <li class="nav-item">
                  <a href="pages/forms/basic_elements.html" class="nav-link">
                    <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    <span class="menu-title">Product</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="mdi mdi-finance menu-icon"></i>
                    <span class="menu-title">Ganti password</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="mdi mdi-finance menu-icon"></i>
                    <span class="menu-title">Logout</span>
                    <i class="menu-arrow"></i>
                  </a>
              </li>
            </ul>
        </div>
      </nav>
    </div>

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">


            @yield('content')


        </div>
        <!-- content-wrapper ends -->
        <!-- partial:kasir/partials/_footer.html -->
        <footer class="footer">
          <div class="footer-wrap">
              <div class="w-100 clearfix">
                <span class="d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash</a>. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart-outline"></i></span>
              </div>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="{{asset('kasir/vendors/base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('kasir/js/template.js')}}"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="{{asset('kasir/vendors/chart.js/Chart.min.js')}}"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="{{asset('kasir/js/chart.js')}}"></script>
  <!-- End custom js for this page-->
</body>

</html>
