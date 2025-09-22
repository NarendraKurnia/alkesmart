@include('layout.head')
@include('layout.header')

<body class="min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 pt-16">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 bg-white p-6 rounded-xl shadow-md">
            @csrf

            <!-- Bagian Data Pengguna -->
            <section class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">Data Diri</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama" required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Nomor Handphone</label>
                        <input type="text" name="kontak" value="{{ old('kontak') }}" placeholder="08123456789" required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-1 font-medium text-gray-700">Alamat</label>
                        <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat" required
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">ID Paypal</label>
                        <input type="text" name="id_paypal" value="{{ old('id_paypal') }}" placeholder="Paypal ID"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium text-gray-700">Email</label>
                        <input type="text" name="email" value="{{ old('email') }}" placeholder="Bank"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </section>

            <!-- Bagian Pilihan Pembayaran -->
            <section class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">Pilihan Pembayaran</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Contoh Payment Option -->
                    <div class="payment-option bg-white p-4 rounded-lg border border-gray-200 shadow-sm cursor-pointer" data-method="bca">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-blue-800 font-bold text-sm">BCA</span>
                            </div>
                            <h3 class="font-medium text-gray-800">BCA</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">3589908</p>
                        <p class="text-sm text-gray-600">a.n Sukses Abadi</p>
                    </div>

                    <div class="payment-option bg-white p-4 rounded-lg border border-gray-200 shadow-sm cursor-pointer" data-method="gopay">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-green-800 font-bold text-sm">G</span>
                            </div>
                            <h3 class="font-medium text-gray-800">GO-PAY</h3>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">082289765478</p>
                        <p class="text-sm text-gray-600">a.n Sukses Abadi</p>
                    </div>
                </div>

                <input type="hidden" name="payment_method" id="payment_method" value="">

                <!-- Form Upload Foto (Hidden by Default) -->
                <div id="uploadContainer" class="mt-4 hidden">
                    <label class="block mb-1 font-medium text-gray-700">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" accept="image/*" class="w-full border rounded-md p-2">
                </div>
            </section>

            <!-- Bagian Daftar Produk -->
            <section class="space-y-4">
                <h2 class="text-2xl font-semibold text-gray-700 border-b pb-2 mb-4">Daftar Produk</h2>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="bg-gray-100 border-b">
                                <th class="py-2 px-3">No.</th>
                                <th class="py-2 px-3">Nama Produk</th>
                                <th class="py-2 px-3">Jumlah</th>
                                <th class="py-2 px-3">Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $index => $product)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-3">{{ $index + 1 }}</td>
                                <td class="py-2 px-3">{{ $product->nama }}</td>
                                <td class="py-2 px-3">{{ $cart[$product->id_produk]['quantity'] ?? 0 }}</td>
                                <td class="py-2 px-3">Rp{{ number_format($product->harga,0,',','.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Total Belanja -->
                <div class="mt-4 p-4 bg-blue-50 rounded-lg flex justify-between items-center">
                    <span class="text-lg font-medium text-gray-800">Total Belanja:</span>
                    <span class="text-xl font-bold text-blue-700">
                        Rp{{ number_format($products->sum(function($prod) use ($cart) {
                            return ($cart[$prod->id_produk]['quantity'] ?? 0) * $prod->harga;
                        }),0,',','.') }}
                    </span>
                </div>
            </section>

            <!-- Tombol Checkout -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-md font-medium hover:bg-blue-700 transition-colors flex items-center justify-center">
                <i class="fas fa-check-circle mr-2"></i> Checkout Sekarang
            </button>
        </form>
    </div>
     <script>
        const paymentOptions = document.querySelectorAll('.payment-option');
        const paymentInput = document.getElementById('payment_method');
        const uploadContainer = document.getElementById('uploadContainer');

        paymentOptions.forEach(option => {
            option.addEventListener('click', () => {
                // Hapus highlight dari semua opsi
                paymentOptions.forEach(o => o.classList.remove('border-blue-500', 'shadow-lg'));
                // Highlight opsi terpilih
                option.classList.add('border-blue-500', 'shadow-lg');

                // Set metode pembayaran
                paymentInput.value = option.dataset.method;

                // Tampilkan form upload foto
                uploadContainer.classList.remove('hidden');
            });
        });
    </script>


@include('layout.footer')
