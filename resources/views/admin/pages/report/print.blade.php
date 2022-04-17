<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .border {
            border: 3px solid black;
            height: 98%;
        }
        .text-center {
            text-align: center;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table tr td, .table th {
            padding:5px;
            border: 1px solid black;
        }
        h2 {
            margin-bottom: 5px;
        }
        p {
            margin-bottom: 5px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="">
        <div class="">
            <div class="text-center header">
                <div style="margin-bottom:10px">
{{--                    <img src="{{ public_path('img/logo.png') }}" alt="logo" width="80">--}}
                </div>
                <h2>Sistem Informasi Ecommerce</h2>
                <p>Alamat: Jl. Raya Test Test</p>
                <p>Tlp : 088219162457</p>
            </div>
            <hr>
            <h3>Income Report</h3>
        </div>

        @foreach($shippings as $date => $shipments)
            @php
                $total = 0;
            @endphp
            <br>
            <span>Date: {{ $date }}</span>
            <table class="table" style="margin-top: 10px;">
                <tbody>
                    @foreach($shipments as $shipment)
                        <tr>
                            <td colspan="5" style="font-weight: bold;">{{ $shipment->user->name }}</td>
                            <td style="font-weight: bold;">Amount</td>
                        </tr>

                        @foreach($shipment->orders as $order)
                            @php
                                $total += $order->product->price;
                            @endphp
                            <tr>
                                <td colspan="5">- {{ $order->product->name }} &nbsp; (x{{ $order->quantity }})</td>
                                <td>Rp. {{ number_format($order->product->price, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    <tr>
                        <td style="font-weight: bold;" colspan="5">Total</td>
                        <td style="font-weight: bold;">Rp. {{ number_format($total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach

        <div style="float: right; margin-right: 70px; margin-top: 70px;">
            <div style="text-align: center;">
                <div>Blahkiuh, {{ date('d-m-Y') }}</div>
                <div style="margin-top: 90px;">Kepala Pasar</div>
            </div>
        </div>
    </div>
</body>
</html>
