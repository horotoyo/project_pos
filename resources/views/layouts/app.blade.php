<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DeLatte | @yield('title')</title>

  @include('layouts.parts.css')
  
  @yield('css')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('layouts.parts.header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.parts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('content')

  </div>
  <!-- /.content-wrapper -->
  @include('layouts.parts.footer')

  <!-- Control Sidebar -->
  {{-- @include('layouts.parts.setting') --}}
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include('layouts.parts.script')

@yield('script')

</body>
</html>
