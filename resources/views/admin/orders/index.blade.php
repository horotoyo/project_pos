@extends('layouts.app')

@section('title', 'Orders')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Orders
    <small>kedaimasuryo.com</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a>Orders</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="{{ route('orders.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th>Table Number</th>
              <th>Total</th>
              <th>Payment Type</th>
              <th>Date</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php
            	$nomor = 1;
            @endphp
            @foreach ($orders as $order)
            <tr>
            	<td width="20px">{{ $nomor++ }}</td>
              <td>{{ $order->table_number }}</td>
              <td>Rp {{ number_format($order->total, 0, ",", ".") }}</td>
              <td>{{ $order->payment->name }}</td>
            	<td>{{ $order->created_at->format('d M Y') }}</td>
            	<td>
            		<form method="post" action="{{ route('orders.destroy', $order->id) }}">
            			@csrf
            			@method('DELETE')
            			<a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-xs">Edit</a>
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