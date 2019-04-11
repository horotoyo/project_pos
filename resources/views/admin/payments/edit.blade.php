@extends('layouts.app')

@section('title', 'Edit Payment')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Payment
    <small>kedaimasuryo.com</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('payments.index') }}">Payments</a></li>
    <li><a>Edit Payment</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        <form method="post" action="{{ route('payments.update', $payment->id) }}">
          @csrf
          @method('PUT')
          <div class="box-body">
            <div class="form-group">
              <label for="name">Payment Name</label>
              <input type="text" class="form-control" name="name" id="name" value="{{ $payment->name }}">
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <a href="{{ route('payments.index') }}" class="btn btn-default">Cancel</a>
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