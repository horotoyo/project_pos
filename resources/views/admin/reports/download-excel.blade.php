<!DOCTYPE html>
<html>
<head>
  <title>Download</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container-fluid mt-2">

      <table>
        <tr>
          <td colspan="6">
            <h2>Order Report</h2>  
          </td>
        </tr>
        <tr>
          <td colspan="6">
            <h6>Date Print: {{ date('d/m/Y') }}</h6>
          </td>
        </tr>
      </table>

      <table class="table table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Table</th>
          <th>Total</th>
          <th>Payment</th>
          <th>Cashier</th>
          <th>Date</th>
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
          <td>{{ $order->user->name }}</td>
          <td>{{ $order->created_at->format('d M Y') }}</td>
        </tr>
        @endforeach
        </tbody>
      </table>

</div>
</body>
</html>