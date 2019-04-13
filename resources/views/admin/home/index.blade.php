@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <a href="{{ route('categories.index') }}"><span class="info-box-icon bg-red"><i class="fa fa-tags"></i></span></a>

        <div class="info-box-content">
          <span class="info-box-text">Categories</span>
          <span class="info-box-number">{{ count($categories) }} <small>Items Available</small></span>
          <a href="{{ route('categories.index') }}" class="btn btn-danger btn-xs">Show More</a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <a href="{{ route('products.index') }}"><span class="info-box-icon bg-aqua"><i class="fa fa-coffee"></i></span></a>

        <div class="info-box-content">
          <span class="info-box-text">Products</span>
          <span class="info-box-number">{{ count($products) }} <small>Items Available</small></span>
          <a href="{{ route('products.index') }}" class="btn btn-info btn-xs">Show More</a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <a href="{{ route('orders.index') }}"><span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span></a>

        <div class="info-box-content">
          <span class="info-box-text">Order</span>
          <span class="info-box-number">{{ $orders }} <small>Order on this day</small></span>
          <a href="{{ route('orders.index') }}" class="btn btn-success btn-xs">Show More</a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <a href="{{ route('users.index') }}"><span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span></a>

        <div class="info-box-content">
          <span class="info-box-text">Users</span>
          <span class="info-box-number">{{ count($users) }} <small>User Account</small></span>
          <a href="{{ route('users.index') }}" class="btn btn-warning btn-xs">Show More</a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    
  </div>
  <!-- /.row (main row) -->

</section>
<!-- /.content -->
@endsection