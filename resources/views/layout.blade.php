<!DOCTYPE html>
<html lang="en">
@include('partials.head')

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

 

    <!-- Navbar -->
    @include('partials.nav')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('partials.aside')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
     
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      @yield('content')

      <!-- /.content -->
    </div>
    @include('partials.footer')
  </div>
  <script src="{{asset('/js/app.js')}}"></script>
@yield('scripts')
</body>

</html>