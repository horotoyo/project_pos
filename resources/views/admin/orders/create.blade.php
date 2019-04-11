@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Order
    <small>kedaimasuryo.com</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('orders.index') }}">Orders</a></li>
    <li><a>Create Order</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        <form method="post" action="{{ route('orders.store') }}">
          @csrf
          <div class="box-body">

            <div class="form-group">
              <label for="table_number">Table Number</label>
              <input type="number" class="form-control" name="table_number" id="table_number" placeholder="Enter Table Number">
            </div>

            <div class="form-group">
              <label>Product Name</label>
              <select name="product_id" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="">Choose one for product name</option>
                @foreach ($products as $product)
                  <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity of Order Product">
            </div>

            <div class="form-group">
              <label>Payment Type</label>
              <select name="payment_id" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="">Choose one for payment type</option>
                @foreach ($payments as $payment)
                  <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                @endforeach
              </select>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <a href="{{ route('orders.index') }}" class="btn btn-default">Cancel</a>
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