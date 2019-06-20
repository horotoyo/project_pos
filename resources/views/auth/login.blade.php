@extends('auth.app')

@section('title', 'Login')

@section('content')
<div class="login-box">
  <div class="text-center" style="margin-bottom: 10px">
    <img src="{{ asset('favicon2.ico') }}" width="60px">
  </div>
  <div class="login-logo">
    <a href="{{ route('login') }}"><b>De</b>Latte<small>.com</small></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    @if ($message = Session::get('success'))
      <div class="alert alert-info alert-block" style="margin-top: 10px">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
      </div>
    @endif
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login') }}" method="post">
      @csrf
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email" value="suryowidiyantogm@gmail.com">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" value="12345678">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
        <p style="text-align: center;">OR</p>
        <a href="{{ url('socialauth/facebook') }}" class="btn btn-block btn-social btn-facebook btn-flat">
          <i class="fa fa-facebook"></i> Sign in using Facebook</a>
        <a href="{{ url('socialauth/github') }}" class="btn btn-block btn-social btn-github btn-flat">
          <i class="fa fa-github"></i> Sign in using Github</a>
        <p style="margin-top: 10px;"><a href="{{ route('password.request') }}"><i class="fa fa-lock"></i> Forgot your password?</a></p>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection