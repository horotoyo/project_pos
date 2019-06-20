@extends('auth.app')

@section('title', 'Reset Password')

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
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <p class="login-box-msg">Reset your password</p>

    <form action="{{ route('password.request') }}" method="post">
      @csrf

      <input type="hidden" name="token" value="{{ $token }}">

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback" required>
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
        <input type="password" class="form-control" name="password_confirmation" placeholder="Password Confirmation" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Send</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection