@extends('layouts.app')

@section('title', 'Create Order')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Create Order
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('home.index') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('orders.index') }}">Orders</a></li>
    <li class="active">Create Order</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div id="app">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <a href="{{ route('orders.index') }}" class="btn btn-warning"><i class="fa fa-arrow-circle-left"></i> Back</a>
          {{-- <button type="button" class="btn btn-success" id="addproduct"><i class="fa fa-plus"></i></button> <label>Add new product</label> --}}
        </div>

        
        <form method="post" action="{{ route('orders.store') }}">
          @csrf
          <div class="box-body">
            <div class="row">

              {{-- box list menu --}}
              <div class="col-md-8">
              Select Product

                <div class="row product" v-for="(order, index) in orders" :key="index">

                  <div id="product-box1">
                    <div class="col-md-4">
                      <div class="form-group">
                        <select name="product_id[]" class="form-control select2" style="width: 100%;" v-model="order.product_id">
                          <option selected="selected" value="">Product name 1</option>
                          @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                          @endforeach
                        </select>
                      </div>
                    <input type="hidden" name="product_name[]" :value="product_name(order.product_id, index)">
                    <input type="hidden" name="product_price[]" :value="product_price(order.product_id, index)">
                    </div>


                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="number" class="form-control" name="quantity[]" id="quantity" placeholder="Qty" v-model="order.quantity">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <input type="text" class="form-control" name="note[]" id="note" placeholder="Note" v-model="order.note">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="text" class="form-control" name="subtotal[]" id="subtotal" placeholder="Subtotal" v-model="order.subtotal"
                        :value="subtotal(order.product_id, order.quantity, index)" readonly>
                      </div>
                    </div>

                    <div class="col-md-1">
                      <button type="button" class="btn btn-danger" @click="delDetail(index)"><i class="fa fa-trash"></i></button>
                    </div>
                  </div>
                </div>
                
                <button type="button" class="btn btn-success" @click="addDetail"><i class="fa fa-plus"></i> Add Product</button>
              </div>
              

              {{-- box details --}}
              <div class="col-md-4 pull-right">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      Employee
                      <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                    </div>
                  </div>

                  <div class="col-md-6">
                    Date Order
                    <input type="text" class="form-control" value="{{ date('d M Y ') }} {{ date('H:m') }}" disabled>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    Table Number
                    <input type="text" name="table_number" class="form-control">
                  </div>
                  <div class="col-md-6">
                    Payment Method
                    <select name="payment_id" class="form-control select2" style="width: 100%;">
                      <option selected="selected" value="">Choose one</option>
                      @foreach ($payments as $payment)
                        <option value="{{ $payment->id }}">{{ $payment->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                  <div class="col-md-12">
                    <div class="form-group">
                      Customer Email
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-envelope-o"></i>
                        </span>
                        <input type="text" name="email" class="form-control" placeholder="ex: john@gmail.com">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      Discount
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-money"></i>
                        </span>
                        <input type="number" name="discount" class="form-control valid" v-model="discount">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      Total Price
                      <input type="text" class="form-control" style="font-weight: bold;" name="total" :value="total" readonly>
                    </div>
                  </div>
                </div>


              </div>

            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-send"></i> Submit</button>
          </div>
        </form>


      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  </div>
</section>
<!-- /.content -->
@endsection

@section('script')

<script src="{{ asset('adminlte/dist/js/vue.min.js') }}"></script>
<script>
    new Vue({
      el    : '#app',
      data  : {
        orders : [
          {product_id: 0, product_name:"", product_price: 0, quantity: 1, subtotal: 0, note:""},
        ],
          discount : 0,
      },

      methods : {
        addDetail() {
          var orders = {product_id: 0, product_name:"", product_price: 0, quantity: 1, subtotal: 0, note:""};

          this.orders.push(orders);
        },
        delDetail(index) {
          if(index > 0) {
            this.orders.splice(index, 1);
          }
        },
        subtotal(product_id, quantity, index) {
          var subtotal = this.products[product_id] * quantity;
          this.orders[index].subtotal = subtotal;
          return subtotal;
        },
        formatPrice(value) {
            return 'Rp '+value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        product_price(product_id, index) {
          var product_price = this.products[product_id];
          this.orders[index].product_price = product_price;
          return product_price;
        },
        product_name(product_id, index) {
          var product_name = this.names[product_id];
          this.orders[index].product_name = product_name;
          return product_name;
        },
      },

      computed: {
        products() {
          var products  = [];
          products[0]   = 0;

          @foreach ($products as $product)
            products[{{ $product->id }}] = {{ $product->price }}
          @endforeach

          return products;
        },
        names() {
          var products = [];
          products[0] = 0;

          @foreach($products as $product)
            products[ {{ $product->id }} ] = "{{ $product->name }}"
          @endforeach
          return products;
        },
        total() {
          var total = this.orders
          .map( order => order.subtotal )
          .reduce( (prev, next) => prev + next );

          return total - (total * this.discount / 100);
        },
      },
    });
</script>
@endsection