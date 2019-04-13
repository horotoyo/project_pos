@extends('layouts.app')

@section('title', 'Create Payment')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Payment
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('payments.index') }}">Payments</a></li>
    <li class="active">Create Payment</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="{{ route('payments.index') }}" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>

        <form method="post" action="{{ route('payments.store') }}">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="name">Payment Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Payment Name">
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <a href="{{ route('payments.index') }}" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-primary">Submit</button>
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