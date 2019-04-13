@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create User
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li class="active">Edit User</li>
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

        <form method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">User Name</label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                  @if ($errors->has('name'))
                      <span>{{ $errors->first('name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                  @if ($errors->has('email'))
                      <span>{{ $errors->first('email') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" id="password">
                  @if ($errors->has('password'))
                      <span>{{ $errors->first('password') }}</span>
                  @endif
                </div>
              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <label for="photo">Photo</label>
                  <input type="file" name="photo" id="photo" style="margin-bottom: 1.3rem;">
                  <img src="{{ Storage::url($user->photo) }}" width="100px">
                </div>
              </div>
            </div>           

          </div>

          <div class="box-footer">
            <button type="submit" class="btn btn-info"><i class="fa fa-send"></i> Update</button>
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