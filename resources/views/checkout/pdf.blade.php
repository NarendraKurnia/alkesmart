<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transaksi {{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #eee; }
        img { max-width: 150px; margin-top: 5px; }
        h1, h2 { text-align: center; }
    </style>
</head>
<body>
    <h1>Transaksi Berhasil</h1>
    <h2>ID Order: {{ $order->id }}</h2>

    <p><strong>Nama:</strong> {{ $order->nama }}</p>
    <p><strong>Kontak:</strong> {{ $order->kontak }}</p>
    <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</p>

    @if($order->bukti_pembayaran)
        <p><strong>Bukti Pembayaran:</strong></p>
        <img src="{{ public_path('storage/'.$order->bukti_pembayaran) }}" alt="Bukti Pembayaran">
    @endif

    <h3>Produk Dibeli</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp{{ number_format($item->harga_satuan,0,',','.') }}</td>
                <td>Rp{{ number_format($item->total_harga,0,',','.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total Belanja:</strong> Rp{{ number_format($order->total_harga,0,',','.') }}</p>
</body>
</html>
