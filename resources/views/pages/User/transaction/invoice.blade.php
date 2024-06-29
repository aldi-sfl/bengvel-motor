<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    {{-- <link rel="stylesheet" href="../css/invoice.css"> --}}
    <style>
            * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            }

            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                padding: 20px;
                background-color: #f7f7f7;
            }

            .invoice-container {
                max-width: 800px;
                margin: 0 auto;
                background: white;
                padding: 20px;
                border: 1px solid #ccc;
            }

            header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .logo {
                width: 150px;
            }

            .invoice-info {
                text-align: right;
            }

            .invoice-info h2 {
                margin-bottom: 5px;
                color: #fa4c4c;
            }

            .details {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .details h3 {
                margin-bottom: 5px;
            }

            .product-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            }

            .product-info th, .product-info td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            .product-info th {
                background-color: #f2f2f2;
            }

            .product-info td {
                padding: 10px 20px; /* Adjust the padding as needed */
                text-align: left;
            }

            .jumlah, .harga-satuan, .total-harga {
                text-align: center;
            }

            /* Add margin specifically for each column if needed */
            .info-produk {
                margin-left: 10px; /* Adjust the margin as needed */
            }

            .jumlah {
                margin-left: 10px;
            }

            .harga-satuan {
                margin-left: 10px;
            }

            .total-harga {
                margin-left: 10px;
            }

            .product-info,
            .summary {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            .product-info th,
            .summary td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            .product-info th {
                background-color: #f2f2f2;
            }

            .summary td {
                background-color: #f9f9f9;
            }

            .protection {
                display: inline-block;
                padding: 2px 4px;
                background-color: #4caf50;
                color: white;
                font-size: 12px;
                border-radius: 3px;
            }

            .additional {
                background-color: #f9f9f9;
            }
            .address {
                width: 250px; 
                word-wrap: break-word;
            }
            .back-button {
                display: inline-block;
                margin-bottom: 16px;
                margin-right: 4px;
                padding: 8px 16px;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s;
            }
            .back-button:hover {
                background-color: #0056b3;
            }
            .download-button {
                display: inline-flex;
                align-items: center;
                padding: 8px 16px;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                transition: background-color 0.3s;
                cursor: pointer;
            }
            .download-button:hover {
                background-color: #0056b3;
            }
            .download-button .icon {
                margin-right: 8px;
                display: inline-block;
                rotate: 180deg;
                width: 20px;
                height: 20px;
            }
            .download-button .icon svg {
                fill: white;
            }


    </style>
</head>
<body>
    <a href="javascript:history.back()" class="back-button">Back</a>
    <a href="{{ route('download.invoice',['id' => $orders->id]) }}" class="download-button">
        <span class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" width="19" height="19">
                <path d="M5 20h14v-2H5v2zM12 2l-5.5 5.5h3.5v7h4v-7h3.5L12 2z"/>
            </svg>
        </span>
        Download
    </a>
    <div class="invoice-container">
        <header>
            {{-- <img src="../image/gas.png" alt="Logo" class="logo"> --}}
            <div class="invoice-info">
                <h2>INVOICE</h2>
            </div>
        </header>
        <div class="details">
            <div class="issued">
                <h3>DITERBITKAN ATAS NAMA</h3>
                <p>Penjual: <strong>ORBIT</strong></p>
            </div>
            <div class="for">
                <h3>UNTUK</h3>
                <p>Pembeli: <strong>{{ $orders->user->name }}</strong></p>
                <p>Tanggal Pembelian: <strong>{{ $orders->created_at->format('d M Y')  }}</strong></p>
                @if($orders->shipping)
                    <p>Metode Pengiriman: {{ $orders->shipping->shipping_method }}</p>
                    @if ($orders->shipping->shipping_method === "kirim-paket")
                        <p class="address">Alamat pengiriman: {{ $orders->shipping->address }}</p>
                        <p>Kurir: <span style="text-transform: uppercase;">{{ $orders->shipping->courier_provider }}</span> - {{ $orders->shipping->couries_service }}</p>
                    @else
                        <p>-</p>
                    @endif
                    
                @else
                    <p>No shipping information available.</p>
                @endif
            </div>
        </div>
        <table class="product-info">
            <thead>
                <tr>
                    <th>INFO PRODUK</th>
                    <th>JUMLAH</th>
                    <th>HARGA SATUAN</th>
                    <th>TOTAL HARGA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders->transactionDetails as $detail)
                <tr>
                    <td class="info-produk">
                        <strong>{{ $detail->product->name }}</strong>
                        <br>
                        Berat: {{ $detail->product->weight }}gr
                    </td>
                    <td class="jumlah">{{ $detail->quantity }}</td>
                    <td class="harga-satuan">{{ 'Rp' . number_format( $detail->price, 0, ',', '.')  }}</td>
                    <td class="total-harga">{{ 'Rp' . number_format(  $detail->price * $detail->quantity, 0, ',', '.')  }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class="summary">
            <tbody>
                <tr>
                    <td>Total Harga ( {{ $orders->transactionDetails->count() }} Barang)</td>
                    <td>{{ 'Rp' . number_format($orders->total_amount - $orders->shipping->servicce_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total Ongkos Kirim</td>
                    @if($orders->shipping->shipping_method === "kirim-paket")
                    <td>{{ 'Rp' . number_format($orders->shipping->servicce_price, 0, ',', '.') }}</td>
                    @else
                    <td>0</td>
                    @endif
                </tr>
                <tr>
                    <td>Total Tagihan</td>
                    <td>{{ 'Rp' . number_format($orders->total_amount, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
