<!DOCTYPE html>
<html>
<head>
	<title>Invoice Print</title>
	@include('layouts.parts.css')
</head>
<body onload="window.print();">
<div class="wrapper">

<section class="invoice">
	<!-- title row -->
	<div class="row">
	  <div class="col-xs-12">
	  	<h2 class="page-header"><b><i class="fa fa-shopping-cart"></i> Order Detail</b></h2>
	  </div>
	  <!-- /.col -->
	</div>
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
              <td>{{ $order->discount }} %</td>
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
	    {{-- <a href="invoice" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a> --}}
	  </div>
	</div>
</section>

</div>
<!-- ./wrapper -->
@include('layouts.parts.script')
</body>
</html>