@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Product
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('products.index') }}">Products</a></li>
    <li class="active">Create Product</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="{{ route('products.index') }}" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back</a>
        </div>

        <form method="post" action="{{ route('products.store') }}">
          @csrf
          <div class="box-body">

            <div class="form-group">
              <label>Category Name</label>
              <select name="category_id" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="">Choose one for category</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="name">Product Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name">
            </div>

            <div class="form-group">
              <label for="price">Price (Rp)</label>
              <input type="text" class="form-control" name="price" id="price" placeholder="Enter Product Price">
            </div>

            <label>Status</label>
            <div class="form-group">
              <label>
                <input type="radio" name="status" value="0" class="minimal">
                Empty
              </label>
              <label>
                <input type="radio" name="status" value="1" class="minimal">
                Available
              </label>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Submit</button>
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