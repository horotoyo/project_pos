@extends('layouts.app')

@section('title', 'Edit Orders')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Orders
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('orders.index') }}">Orders</a></li>
    <li class="active">Edit Orders</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        <form method="post" action="{{ route('orders.update', $order->id) }}">
          @csrf
          @method('PUT')
          <div class="box-body">

            <div class="form-group">
              <label for="table_number">Table Number</label>
              <input type="number" class="form-control" name="table_number" id="table_number" value="{{ $order->table_number }}">
            </div>

            <div class="form-group">
              <label>Product Name</label>
              <select name="product_id" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="{{ $orderDetail->product_id }}">{{ $orderDetail->product_name }}</option>
                @foreach ($products as $product)
                  <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" name="quantity" id="quantity" value="{{ $orderDetail->quantity }}">
            </div>

            <div class="form-group">
              <label>Payment Type</label>
              <select name="payment_id" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="{{ $order->payment_id }}">{{ $order->payment->name }}</option>
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

@section('script')
<script>
  $(function () {
    $('.select2').select2()

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>
@endsection