@include('layout.head')
@include('layout.header')

<div class="min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 pt-16">
        <h1 class="text-3xl font-bold text-green-700 mb-8 text-center">
            ✅ Transaksi Berhasil
        </h1>

        <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
            <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">Detail Transaksi</h2>

            <p><strong>Nama:</strong> {{ $order->nama }}</p>
            <p><strong>Kontak:</strong> {{ $order->kontak }}</p>
            <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
            <p><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</p>
            @if($order->bukti_pembayaran)
    <p><strong>Bukti Pembayaran:</strong></p>
    <img src="{{ asset($order->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="w-64 mt-2 rounded-md border">
@endif


            <h3 class="text-xl font-semibold text-gray-700 mt-4 mb-2">Produk Dibeli</h3>
            <table class="w-full border-collapse text-left">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="py-2 px-3">Nama Produk</th>
                        <th class="py-2 px-3">Jumlah</th>
                        <th class="py-2 px-3">Harga Satuan</th>
                        <th class="py-2 px-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-3">{{ $item->nama }}</td>
                        <td class="py-2 px-3">{{ $item->qty }}</td>
                        <td class="py-2 px-3">Rp{{ number_format($item->harga_satuan,0,',','.') }}</td>
                        <td class="py-2 px-3">Rp{{ number_format($item->total_harga,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 p-4 bg-blue-50 rounded-lg flex justify-between items-center font-semibold">
                <span>Total Belanja:</span>
                <span class="text-xl text-blue-700">
                    Rp{{ number_format($order->total_harga,0,',','.') }}
                </span>
            </div>
            <a href="{{ route('checkout.pdf', $order->id) }}" 
   class="inline-block mt-4 bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">
   Download PDF
</a>


            <a href="{{ route('home.index') }}" class="inline-block mt-6 bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

@include('layout.footer')
