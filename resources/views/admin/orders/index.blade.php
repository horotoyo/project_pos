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
                  <div class="modal-dialog" style="width:800px;">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><b><i class="fa fa-shopping-cart"></i> Order Detail</b></h4>
                      </div>
                      <div class="modal-body">
                          <!-- info row -->
                          <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                              Order at
                              <address>
                                <strong>{{ $order->created_at->format('d M Y') }}</strong><br>
                                <strong>{{ $order->created_at->format('H:m') }} WIB</strong>
                              </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                              Table Number
                              <address>
                                <strong>{{ $order->table_number }}</strong><br>
                              </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                              Customer Service
                              <address>
                                <strong>{{ $order->user->name }}</strong>
                              </address>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <!-- Table row -->
                          <div class="row">
                            <div class="col-xs-12 table-responsive">
                              <table class="table table-striped">
                                <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Product Name</th>
                                  <th>Price</th>
                                  <th>Qty</th>
                                  <th>Subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                  $no = 1;
                                @endphp
                                @foreach ($order->orderDetail as $detail)
                                <tr>
                                  <td>{{ $no++ }}</td>
                                  <td>{{ $detail->product->name }}</td>
                                  <td>Rp {{ number_format($detail->product->price, 0, ",", ".") }}</td>
                                  <td>{{ $detail->quantity }}</td>
                                  <td>Rp {{ number_format($detail->subdetail, 0, ",", ".") }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                              </table>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">
                              <p class="lead">Payment Methods: <b>{{ $order->payment->name }}</b></p>

                              <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                @foreach ($order->orderDetail as $view)
                                  @if (empty($view->note))
                                    No comments
                                  @else
                                    {{ $view->note }}
                                  @endif
                                @endforeach
                              </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-6">

                              <div class="table-responsive">
                                <table class="table">
                                  <tr>
                                    <th style="width:50%">Total : </th>
                                    <td>Rp {{ number_format($order->total, 0, ",", ".") }}</td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->

                          <!-- this row will not appear when printing -->
                          <div class="row no-print">
                            <div class="col-xs-12">
                              <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                              <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
                              </button>
                              <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                                <i class="fa fa-download"></i> Generate PDF
                              </button>
                            </div>
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