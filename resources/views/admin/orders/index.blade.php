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
<div id="modal-pop">

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Orders
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active ujicoba">Orders</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button> 
              <strong>{{ $message }}</strong>
        </div>
      @endif
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="{{ route('orders.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="table1" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th width="5%">No</th>
              <th>Table Number</th>
              <th>Total</th>
              <th>Payment Type</th>
              <th>Date</th>
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
  @include('admin.orders.detail')

</section>
<!-- /.content -->
</div>
@endsection

@section('script')
  <script src="{{ asset('adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/custom.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/vue.min.js') }}"></script>
  <script src="{{ asset('adminlte/dist/js/axios.min.js') }}"></script>
  <script type="text/javascript">

    function detail(id) {
      vue.getData(id);
      $('.sendmail').attr('action', null);
      $('.sendmail').attr('action', '{{ url('/') }}/sendmail/'+id);

      $('.printinvoice').attr('href', null);
      $('.printinvoice').attr('href', '{{ url('/') }}/orders/'+id+'/print');
    };

    var vue = new Vue({
      el: '#modal-pop',
      data: {
        orders: [],
        test: 1
      },
      methods: {
        getData(id) {
          axios.get("{{ url('/') }}"+'/orders/'+id)
          .then(function(response) {
            vue.orders = response.data;
            // console.log(response.data);
          })
          .catch(function(error) {
            alert(JSON.stringify(error));
          });
        },
        formatPrice(value) {
            return 'Rp '+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        formatDate(value) {
          return moment(String(value)).format('D-M-Y H:m');
        },
        userName(value) {
          var name    = this.users[value];
          return name.replace(value, name);
        },
        paymentName(value) {
          var name    = this.payments[value];
          return name.replace(value, name);
        },
      },
      computed: {
        users() {
          var users  = [];
          users[0]   = 'undefined';

          @foreach ($users as $user)
            users[{{ $user->id }}] = '{{ $user->name }}'
          @endforeach

          return users;
        },
        payments() {
          var payments  = [];
          payments[0]   = 'undefined';

          @foreach ($payments as $payment)
            payments[{{ $payment->id }}] = '{{ $payment->name }}'
          @endforeach

          return payments;
        },
      },

    });

    var table;
    $(document).ready(function() {
        table = $('#table1').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{$ajax}}',
            order: [[0,'desc']],
            columns: [
                { data: 'id'},
                { data: 'table_number', searchable: true, orderable: true},
                { data: 'total', searchable: true, orderable: true},
                { data: 'payment_id', searchable: true, orderable: true},
                { data: 'created_at', searchable: true, orderable: true},
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