@extends('auth.app')

@section('title', 'Request Link')

@section('content')
<div class="login-box">
  <div class="text-center" style="margin-bottom: 10px">
    <img src="{{ asset('favicon2.ico') }}" width="60px">
  </div>
  <div class="login-logo">
    <a href="{{ asset('adminlte/index2.html') }}"><b>De</b>Latte<small>.com</small></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <p class="login-box-msg">We will send <b>reset link</b> to your email</p>

    <form action="{{ route('password.email') }}" method="post">
      @csrf
      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
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