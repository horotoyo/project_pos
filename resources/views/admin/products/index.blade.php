@extends('layouts.app')

@section('title', 'Products')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Products
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Products</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th>Category</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php
            	$nomor = 1;
            @endphp
            @foreach ($products as $product)
            <tr>
            	<td width="20px">{{ $nomor++ }}</td>
              <td>{{ $product->category->name }}</td>
              <td>{{ $product->name }}</td>
              <td>Rp {{ number_format($product->price, 0, ",", ".") }}</td>
            	<td>{{ ($product->status)?'Available':'Empty' }}</td>
            	<td>
            		<form method="post" action="{{ route('products.destroy', $product->id) }}">
            			@csrf
            			@method('DELETE')
            			<a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-xs">Edit</a>
            			<button type="submit" class="btn btn-danger btn-xs">Delete</button>
            		</form>
            	</td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
@endsection