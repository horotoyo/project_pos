<div class="modal fade" id="modal-baru" v-if="orders['order']">
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
            <div class="col-sm-3 invoice-col">
              Date at
              <address>
                <strong>@{{ formatDate(orders['order'].created_at) }} WIB</strong><br>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
              Table Number
              <address>
                <strong>@{{ orders['order'].table_number }}</strong><br>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
              Customer Email
              <address>
                <strong>@{{ orders['order'].email }}</strong>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
              Chasieer
              <address>
                <strong>@{{ userName(orders['order'].user_id) }}</strong>
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

                    <tr v-for="(detail, index) in orders.detail" :key="detail.id">
                      <td>@{{ index+1 }}</td>
                      <td>@{{ detail.product_name }}</td>
                      <td>@{{ detail.note }}</td>
                      <td>@{{ formatPrice(detail.product_price) }}</td>
                      <td>@{{ detail.quantity }}</td>
                      <td>@{{ formatPrice(detail.subtotal) }}</td>
                    </tr>
                  
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
              <p class="lead">Payment Methods: <b>@{{ paymentName(orders['order'].payment_id) }}</b></p>

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
                    <td>@{{ orders['order'].discount }} %</td>
                  </tr>
                  <tr>
                    <th style="width:50%">Total : </th>
                    <td>@{{ formatPrice(orders['order'].total) }}</td>
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
              <form method="post" action="" class="sendmail">
                @csrf
                <a href="" target="_blank" class="btn btn-default printinvoice"><i class="fa fa-print"></i> Print</a>
                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> Send Mail</button>
                <button type="button" class="btn btn-danger pull-right" style="margin-right: 5px;" data-dismiss="modal" aria-label="Close">
                  <i class="fa fa-remove"></i> Cancel
                </button>

              </form>
            </div>
          </div>
      
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->