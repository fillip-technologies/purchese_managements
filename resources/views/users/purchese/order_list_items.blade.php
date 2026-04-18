<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Purchase Order List</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
        }

        .box {
            border: 1px solid #ddd;
            padding: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background: #f2f2f2;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <div class="title">Purchase Order List</div>
        <div>PO No: {{ $order->po_number }}</div>
        <div>Date: {{ date('d M Y', strtotime($order->created_at)) }}</div>
    </div>

    <!-- Vendor + Client -->
    <table>
        <tr>
            <td width="50%">
                <div class="box">
                    <strong>Vendor Info</strong><br>
                    Name: {{ $order->vendor->vendor_name ?? '-' }}<br>
                    Email: {{ $order->vendor->email ?? '-' }}<br>
                    Phone: {{ $order->vendor->phone ?? '-' }}
                </div>
            </td>

            <td width="50%">
                <div class="box">
                    <strong>Client Info</strong><br>
                    Name: {{ $order->client->client_name ?? '-' }}<br>
                    Company: {{ $order->client->company_name ?? '-' }}<br>
                    Address: {{ $order->client->address ?? '-' }}
                </div>
            </td>
        </tr>
    </table>

    <!-- User Info -->
    <div class="box" style="margin-top:10px;">
        <strong>User Info</strong><br>
        Requested By (User ID): {{ $order->requisition->requested_by ?? '-' }}<br>
        Approved By: {{ $order->approver->full_name ?? '-' }}
    </div>

    <!-- Product Table -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product ID</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $key => $item)
                <tr>
                    <td style="text-align:center;">{{ $key + 1 }}</td>
                    <td style="text-align:center;">{{ optional($item->product)->product_name ?? '-' }}</td>
                    <td style="text-align:center;">{{ $item->quantity }}</td>
                    <td style="text-align:center;">₹ {{ number_format($item->price, 2) }}</td>
                    <td style="text-align:center;">₹ {{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals -->
    <table>
        <tr>
            <td class="right"><strong>Subtotal:</strong></td>
            <td width="150">₹ {{ number_format($order->subtotal, 2) }}</td>
        </tr>
        <tr>
            <td class="right"><strong>GST:</strong></td>
            <td>₹ {{ number_format($order->gst_amount, 2) }}</td>
        </tr>
        <tr>
            <td class="right"><strong>Total:</strong></td>
            <td><strong>₹ {{ number_format($order->total_amount, 2) }}</strong></td>
        </tr>
    </table>

</body>
</html>
