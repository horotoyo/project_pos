@extends('layouts.app')

@section('title', 'Orders')

@section('css')
  <style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Orders
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Orders</li>
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
                  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#{{ $order->id }}">Detail</button>
            			<a href="{{ route('orders.edit', $order->id) }}" class="btn btn-primary btn-xs">Edit</a>
            			<button type="submit" class="btn btn-danger btn-xs">Delete</button>
            		</form>

                 <div class="modal fade" id="{{ $order->id }}">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Order Detail Table Number {{ $order->table_number }}</h4>
                      </div>
                      <div class="modal-body text-left">
                        <div class="row">
                          <div class="col-md-3">Table Number</div>
                          <div class="col-md-6">: {{ $order->table_number }}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">Payment Type</div>
                          <div class="col-md-6">: {{ $order->payment->name }}</div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">Table Number</div>
                          <div class="col-md-6">: {{ $order->table_number }}</div>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

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