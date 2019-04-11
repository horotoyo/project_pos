@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create User
    <small>kedaimasuryo.com</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a>Edit User</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        <form method="post" action="{{ route('users.update', $user->id) }}">
          @csrf
          @method('PUT')
          <div class="box-body">

            <div class="form-group">
              <label for="name">User Name</label>
              <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="text" class="form-control" name="password" id="password">
            </div>

            <div class="form-group">
              <label for="photo">Photo</label>
              <input type="file" class="form-control" name="photo" id="photo" style="margin-bottom: 1.3rem;">
              <img src="{{ Storage::url($user->photo) }}" width="100px">
            </div>

          </div>

          <div class="box-footer">
            <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-info">Update</button>
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