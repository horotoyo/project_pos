@extends('layouts.app')

@section('title', 'Create User')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create User
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li class="active">Create User</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="{{ route('users.index') }}" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>

        <form method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
          
            <div class="form-group">
              <label for="name">User Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter user Name">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter User Email">
            </div>
          
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Enter User Password">
            </div>
          
            <div class="form-group">
              <label for="photo">Photo</label>
              <input type="file" name="photo" id="photo">
            </div>
          
          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection