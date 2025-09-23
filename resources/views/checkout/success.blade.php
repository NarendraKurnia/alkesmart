@include('layout.head')
@include('layout.header')

@php
    // pastikan $order tersedia (dibawa dari controller)
    $payment = strtolower($order->status ?? 'pending');
    $ship = strtolower($order->shipping_status ?? 'pending');

    // terima kedua ejaan agar aman
    $isCanceled = in_array($ship, ['canceled', 'cancelled']) || in_array($payment, ['canceled', 'cancelled']);

    // status yang dianggap sedang dikirim
    $inTransit = in_array($ship, [
        'shipped', 'on_delivery', 'in_transit', 'delivering',
        'on_the_way', 'on the way', 'in transit'
    ]);
@endphp

<div class="min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 pt-16">
        <h1 class="text-3xl font-bold mb-8 text-center {{ $isCanceled ? 'text-gray-500' : 'text-green-700' }}">
            @if($isCanceled)
                ❌ Transaksi Dibatalkan
                <div class="mt-2 text-base font-normal text-gray-500">
                    Pesanan #{{ $order->id }} telah dibatalkan.
                </div>
            @else
                ✅ Transaksi Berhasil
                <div class="mt-2 text-base font-normal text-green-600">
                    Silahkan menunggu konfirmasi transaksi
                </div>
            @endif
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

            {{-- STATUS BAYAR & STATUS KIRIM --}}
            @php
                $payment = strtolower($order->status ?? 'pending');
                $ship = strtolower($order->shipping_status ?? 'pending');
                // definisikan status yang kita anggap "sedang dikirim"
                $inTransit = in_array($ship, ['shipped','on_delivery','in_transit','delivering','on the way', 'on_the_way']);
            @endphp

            <div class="mt-4 space-y-2">
                <div>
                    <span class="font-semibold">Status Pembayaran:</span>
                    @if($payment === 'paid')
                        <span class="inline-block ml-2 px-2 py-1 rounded text-sm bg-green-100 text-green-800">Sudah Dibayar</span>
                    @elseif($payment === 'pending')
                        <span class="inline-block ml-2 px-2 py-1 rounded text-sm bg-yellow-100 text-yellow-800">Menunggu Pembayaran</span>
                    @elseif($payment === 'failed' || $payment === 'refunded')
                        <span class="inline-block ml-2 px-2 py-1 rounded text-sm bg-red-100 text-red-800">{{ ucfirst($payment) }}</span>
                    @else
                        <span class="inline-block ml-2 px-2 py-1 rounded text-sm bg-gray-100 text-gray-800">{{ ucfirst($payment) }}</span>
                    @endif
                </div>

                <div>
                @php
                $ship = strtolower($order->shipping_status ?? 'pending');
                $payment = strtolower($order->status ?? 'pending');

                // terima kedua ejaan agar aman
                $isCanceled = in_array($ship, ['canceled', 'cancelled']) || in_array($payment, ['canceled', 'cancelled']);

                // status yang dianggap sedang dikirim
                $inTransit = in_array($ship, [
                    'shipped', 'on_delivery', 'in_transit', 'delivering',
                    'on_the_way', 'on the way', 'in transit'
                ]);
            @endphp

            <div>
                <span class="font-semibold">Status Pengiriman:</span>

                @if($isCanceled)
                    <span class="inline-block ml-2 px-2 py-1 rounded text-sm bg-red-100 text-red-800">Pesanan Dibatalkan</span>

                @elseif($ship === 'delivered')
                    <span class="inline-block ml-2 px-2 py-1 rounded text-sm bg-green-100 text-green-800">Pesanan Sudah Diterima</span>

                @elseif($inTransit)
                    <span class="inline-block ml-2 px-2 py-1 rounded text-sm bg-blue-100 text-blue-800">Barang sedang dalam pengiriman</span>

                @else
                    <span class="inline-block ml-2 px-2 py-1 rounded text-sm bg-yellow-100 text-yellow-800">Belum dikirim</span>

                    @if(!in_array($payment, ['failed','refunded']) && !$isCanceled)
                        <!-- Tombol buka modal -->
                        <button
                            type="button"
                            id="openCancelModalBtn"
                            class="ml-4 bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                        >
                            Batalkan Pesanan
                        </button>

                        <!-- Modal Konfirmasi Pembatalan (Tailwind + vanilla JS) -->
                        <div id="cancelModal" class="fixed inset-0 z-50 hidden items-center justify-center">
                            <!-- Backdrop -->
                            <div id="cancelModalBackdrop" class="absolute inset-0 bg-black bg-opacity-50"></div>

                            <!-- Modal dialog -->
                            <div class="relative bg-white rounded-lg shadow-lg max-w-lg w-full mx-4 z-10">
                                <div class="p-4 border-b">
                                    <h3 class="text-lg font-semibold">Konfirmasi Pembatalan</h3>
                                </div>

                                <div class="p-4">
                                    <p class="text-sm text-gray-700 mb-4">
                                        Apakah Anda yakin ingin membatalkan pesanan <strong>#{{ $order->id }}</strong>?
                                        Aksi ini tidak dapat dikembalikan.
                                    </p>

                                    <div class="flex items-center space-x-3">
                                        <!-- Form pembatalan (ada CSRF) -->
                                        <form id="cancelForm" action="{{ route('orders.cancel', $order->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700">
                                                Ya, Batalkan
                                            </button>
                                        </form>

                                        <button id="closeCancelModalBtn" type="button" class="bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300">
                                            Tidak, Kembali
                                        </button>
                                    </div>
                                </div>

                                <div class="p-3 text-right">
                                    <button id="closeXBtn" class="text-gray-400 hover:text-gray-600">✕</button>
                                </div>
                            </div>
                        </div>

                        <!-- Script untuk toggle modal -->
                        <script>
                            (function() {
                                const openBtn = document.getElementById('openCancelModalBtn');
                                const modal = document.getElementById('cancelModal');
                                const backdrop = document.getElementById('cancelModalBackdrop');
                                const closeBtn = document.getElementById('closeCancelModalBtn');
                                const closeX = document.getElementById('closeXBtn');

                                if (!openBtn || !modal) return;

                                function openModal() {
                                    modal.classList.remove('hidden');
                                    modal.classList.add('flex');
                                    document.getElementById('cancelForm')?.querySelector('button[type="submit"]')?.focus();
                                    document.body.style.overflow = 'hidden';
                                }

                                function closeModal() {
                                    modal.classList.add('hidden');
                                    modal.classList.remove('flex');
                                    document.body.style.overflow = '';
                                    openBtn.focus();
                                }

                                openBtn.addEventListener('click', openModal);
                                closeBtn?.addEventListener('click', closeModal);
                                closeX?.addEventListener('click', closeModal);
                                backdrop?.addEventListener('click', closeModal);

                                document.addEventListener('keydown', function(e) {
                                    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                                        closeModal();
                                    }
                                });
                            })();
                        </script>
                    @endif
                @endif
            </div>
            </div>
            </div>

            <div class="mt-6 flex flex-wrap gap-3">
                @if(!$isCanceled)
                    <a href="{{ route('checkout.pdf', $order->id) }}" 
                    class="inline-block bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700">
                    Download PDF
                    </a>
                @else
                    <span class="inline-block bg-gray-400 text-white py-2 px-4 rounded-md cursor-not-allowed">
                        PDF tidak tersedia (pesanan dibatalkan)
                    </span>
                @endif

                <a href="{{ route('home.index') }}" class="inline-block bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

@include('layout.footer')
