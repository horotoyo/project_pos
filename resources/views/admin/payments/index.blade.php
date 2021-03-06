@extends('layouts.app')

@section('title', 'Payments')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Payments
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Payments</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="{{ route('payments.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>No</th>
              <th>Payment Name</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php
            	$nomor = 1;
            @endphp
            @foreach ($payments as $payment)
            <tr>
            	<td width="20px">{{ $nomor++ }}</td>
            	<td>{{ $payment->name }}</td>
            	<td>
            		<form method="post" action="{{ route('payments.destroy', $payment->id) }}">
            			@csrf
            			@method('DELETE')
            			<a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-primary btn-xs">Edit</a>
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