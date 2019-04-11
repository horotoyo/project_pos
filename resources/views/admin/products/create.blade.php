@extends('layouts.app')

@section('title', 'Create Product')

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Product
    <small>kedaimasuryo.com</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('products.index') }}">Products</a></li>
    <li><a>Create Product</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">

        <form method="post" action="{{ route('products.store') }}">
          @csrf
          <div class="box-body">

            <div class="form-group">
              <label>Minimal</label>
              <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div>

            <div class="form-group">
              <label for="name">Product Name</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name">
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
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
  })
</script>
@endsection