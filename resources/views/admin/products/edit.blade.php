@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Category
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('products.index') }}">Products</a></li>
    <li class="active">Edit Product</li>
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

        <form method="post" action="{{ route('products.update', $product->id) }}">
          @csrf
          @method('PUT')
          <div class="box-body">

            <div class="form-group">
              <label>Category Name</label>
              <select name="category_id" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="{{ $product->category_id }}">{{ $product->category->name }}</option>
                @foreach ($categories as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="name">Product Name</label>
              <input type="text" class="form-control" name="name" id="name" value="{{ $product->name }}">
            </div>

            <div class="form-group">
              <label for="price">Price (Rp)</label>
              <input type="text" class="form-control" name="price" id="price" value="{{ $product->price  }}">
            </div>

            <label>Status</label>
            <div class="form-group">
              <label>
                <input type="radio" name="status" value="0" class="minimal" {{ ($product->status)?'':'checked' }}>
                Empty
              </label>
              <label>
                <input type="radio" name="status" value="1" class="minimal" {{ ($product->status)?'checked':'' }}>
                Available
              </label>
            </div>

          </div>
          <!-- /.box-body -->

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