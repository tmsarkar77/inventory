<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/progress.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/toastify.min.css') }}" />
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <script src="{{ asset('assets/js/axios.min.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" />
</head>

<body>

  <div id="loader" class="LoadingOverlay d-none">
    <div class="Line-Progress">
        <div class="indeterminate"></div>
    </div>
  </div>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
        @include('pages.dashboard.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->

      @include('pages.dashboard.header')
    
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
        <div class="card-body my-2 py-2">
            @yield('section')
        </div>
        </div>
     </div>
     
    </div>
  </div>
 
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>

  <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/js/toastify-js.js') }}"></script>
 

  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('assets/js/app.min.js') }}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>

</body>

</html>