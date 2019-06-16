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
          <table id="table1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th width="5%">No</th>
              <th>Category</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>

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
  <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/custom.js') }}"></script>
  <script type="text/javascript">
    var table;
    $(function() {
        table = $('#table1').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{$ajax}}',
            order: [[0,'desc']],
            columns: [
                { data: 'id'},
                { data: 'category_id', searchable: true, orderable: true},
                { data: 'name', searchable: true, orderable: true},
                { data: 'price', searchable: true, orderable: true},
                { data: 'status', searchable: true, orderable: true},
                { data: 'action', searchable: false, orderable: false}
            ],
            columnDefs: [{
              "targets": 0,
              "searchable": false,
              "orderable": false,
              "data": null,
              "title": 'No',
              "render": function (data, type, full, meta) {
                  return meta.settings._iDisplayStart + meta.row + 1; 
              }
            }],
        });
    });
  </script>
@endsection
