<div class="form-group">
  <label for="table_number">Table Number</label>
  <input type="number" class="form-control" name="table_number" id="table_number" placeholder="Enter Table Number">
</div>

<div class="form-group">
  <label>Product Name</label>
  <select name="product_id" class="form-control select2" style="width: 100%;">
    <option selected="selected" value="">Choose one for product name</option>
    @foreach ($products as $product)
      <option value="{{ $product->id }}">{{ $product->name }}</option>
    @endforeach
  </select>
</div> BERES

<div class="form-group">
  <label for="quantity">Quantity</label>
  <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity of Order Product">
</div> BERES

<div class="form-group">
  <label>Payment Type</label>
  <select name="payment_id" class="form-control select2" style="width: 100%;">
    <option selected="selected" value="">Choose one for payment type</option>
    @foreach ($payments as $payment)
      <option value="{{ $payment->id }}">{{ $payment->name }}</option>
    @endforeach
  </select>
</div>