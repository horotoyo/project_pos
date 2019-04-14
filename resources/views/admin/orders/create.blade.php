@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Order
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('orders.index') }}">Orders</a></li>
    <li class="active">Create Order</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="{{ route('orders.index') }}" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back</a>
          {{-- <button type="button" class="btn btn-success" id="addproduct"><i class="fa fa-plus"></i></button> <label>Add new product</label> --}}
        </div>

        <form method="post" action="{{ route('orders.store') }}">
          @csrf
          <div class="box-body">
            <div class="row">

              {{-- box list menu --}}
              <div class="col-md-4">
              Select Product

                <div class="row product">

                  <div id="product-box1">
                    <div class="col-md-6">
                      <div class="form-group">
                        <select name="product_id[]" class="form-control select2" style="width: 100%;">
                          <option selected="selected" value="">Product name 1</option>
                          @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <input type="number" class="form-control" name="quantity[]" id="quantity" placeholder="Qty">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <a class="btn btn-danger" id="del1">hapus{{-- <i class="fa fa-trash"></i> --}}</a>
                    </div>
                  </div>
                </div>
                
                <button type="button" class="btn btn-success" id="addproduct2"><i class="fa fa-plus"></i></button> <label>Add new product</label>
              </div>

              {{-- box details --}}
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-4 pull-right">
                    <div class="form-group">
                      Employee
                      <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                    </div>
                  </div>

                  <div class="col-md-3 pull-right">
                    Date Order
                    <input type="text" class="form-control" value="{{ date('d M Y ') }} {{ date('H:m') }}" disabled>
                  </div>

                  <div class="col-md-3 pull-right">
                    Table Number
                    <input type="text" name="table_number" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 pull-right">
                    Payment Method
                    <select name="payment_id" class="form-control select2" style="width: 100%;">
                      <option selected="selected" value="">Choose one</option>
                      @foreach ($payments as $payment)
                        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-send"></i> Submit</button>
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
  })
</script>

<script>
  $(document).ready(function(){
    
    var no    = 1;
    var del   = 1;
    var name  = 2;
    var box   = '#product-box'+ no++;
    var btn   = '#del'+ del++;

    $("#addproduct, #addproduct2").click(function(){
      $(".product").append("<div id='product-box"+ no++ +"'><div class='col-md-6'><div class='form-group'><select name='product_id[]' class='form-control select2' style='width: 100%;'><option selected='selected'>Product name "+ name++ +"</option>@foreach ($products as $product)<option value='{{ $product->id }}'>{{ $product->name }}</option>@endforeach</select></div></div><div class='col-md-4'><div class='form-group'><input type='number' class='form-control' name='quantity[]' id='quantity' placeholder='Qty'></div></div><div class='col-md-2'><a class='btn btn-danger' id='del"+ del++ +"'>hapus</a></div></div>");
    });

    $('#del1').click(function() {
      $('#product-box1').remove();
    });    

    var push = 1;
    var fade = 1;

    // $('#del'+ push++).click(function() {
    //   $().remove();
    // });

  });
</script>
@endsection