@extends('layouts.app')

@section('title', 'Report')

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
    Report
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Report</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          {{-- <a href="{{ route('orders.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a> --}}
          <button class="btn btn-default" data-toggle="modal" data-target="#modal-filter"><i class="fa fa-filter"></i> Filter</button>
          <button class="btn btn-primary" data-toggle="modal" data-target="#modal-download"><i class="fa fa-download"></i> Download</button>
          {{-- <a href="{{ route('reports.excel') }}" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export Excel</a> --}}

          {{-- Modal Filter --}}
          <div class="modal fade" id="modal-filter">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Filter Report</h4>
                </div>
                <div class="modal-body">
                  
                  <form class="form-horizontal" method="post" action="{{ route('reports.filter') }}">
                      @csrf
                      <div class="form-group">
                        <label for="year" class="col-sm-2 control-label">Year</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" style="width: 100%" name="year">
                            <option value="">All Years</option>
                            @foreach(range(2010, date('Y')) as $row)
                              <option value="{{$row}}" {{ Input::get('year') == $row ? 'selected' : '' }}>
                                {{ $row }}
                              </option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="month" class="col-sm-2 control-label">Month</label>
                        <div class="col-sm-10">
                          <select class="select2 form-control" name="month" style="width: 100%">
                            <option value="">All Months</option>
                            @for($i=1; $i <= 12; $i++)
                              <option value="{{$i}}" {{ Input::get('month') == $i ? 'selected' : '' }}>
                                {{ date('F', strtotime(date('Y').'-'.$i.'-01')) }}
                              </option>
                            @endfor
                        </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="user" class="col-sm-2 control-label">Cashier</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" style="width: 100%" name="user">
                            <option value="">All Cashiers</option>
                            @foreach($users as $user)
                              <option value="{{ $user->id }}" {{ Input::get('user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                          </select>
                          <div style="margin-top: 16px">
                            <button class="btn btn-primary">Sumbit</button>
                          </div>
                        </div>
                      </div>
                  </form>

                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          {{-- Modal Download --}}
          <div class="modal fade" id="modal-download">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">Download Report</h4>
                </div>
                <div class="modal-body">
                  
                  <form class="form-horizontal" method="post" action="{{ route('reports.export') }}">
                      @csrf
                      <div class="form-group">
                        <label for="year" class="col-sm-2 control-label">Year</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" style="width: 100%" name="year">
                            <option value="">All Years</option>
                            @foreach(range(2010, date('Y')) as $row)
                              <option value="{{$row}}" {{ Input::get('year') == $row ? 'selected' : '' }}>{{ $row }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="month" class="col-sm-2 control-label">Month</label>
                        <div class="col-sm-10">
                          <select class="select2 form-control" name="month" style="width: 100%">
                            <option value="">All Month</option>
                            @for($i=1; $i <= 12; $i++)
                              <option value="{{$i}}" {{ Input::get('month') == $i ? 'selected' : '' }}>
                                {{ date('F', strtotime(date('Y').'-'.$i.'-01')) }}
                              </option>
                            @endfor
                        </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="user" class="col-sm-2 control-label">CS</label>
                        <div class="col-sm-10">
                          <select class="form-control select2" style="width: 100%" name="user">
                            <option value="">All Cashier</option>
                            @foreach($users as $user)
                              <option value="{{ $user->id }}" {{ Input::get('user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="month" class="col-sm-2 control-label">Type File</label>
                        <div class="col-sm-10" style="padding-top: 7px">
                          <label>
                            <input type="radio" name="type" value="0" class="minimal">
                            PDF
                          </label>
                          <label>
                            <input type="radio" name="type" value="1" class="minimal">
                            Excel
                          </label>
                          <div style="margin-top: 16px">
                            <button class="btn btn-primary">Download</button>
                          </div>
                        </div>
                      </div>

                  </form>

                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->          

        </div>
        <!-- /.box-header -->
        <div class="box-body">
          @if ($message = Session::get('success'))
                  <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                      <strong>{{ $message }}</strong>
                </div>
          @endif
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
                  <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#{{ $order->id }}">Detail</button>

                 <div class="modal fade" id="{{ $order->id }}">
                  <div class="modal-dialog" style="width:900px;">
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
                                  <th>Note</th>
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
                                  <td>{{ $detail->product_name }}</td>
                                  <td>{{ $detail->note }}</td>
                                  <td>Rp {{ number_format($detail->product_price, 0, ",", ".") }}</td>
                                  <td>{{ $detail->quantity }}</td>
                                  <td>Rp {{ number_format($detail->subtotal, 0, ",", ".") }}</td>
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
                                  If you have a problem with our service, you can complain to our customer service or call 0879878223781.
                              </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-6">

                              <div class="table-responsive">
                                <table class="table">
                                  <tr>
                                    <th style="width:50%">Discount : </th>
                                    <td>{{ number_format($order->discount) }}%</td>
                                  </tr>
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
                              <a href="{{ route('orders.show', $order->id) }}" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
                              <button type="button" class="btn btn-danger pull-right" style="margin-right: 5px;" data-dismiss="modal" aria-label="Close">
                                <i class="fa fa-remove"></i> Cancel
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

@section('script')
<script>
  $(function () {
    //Initialize Select2 Elements
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