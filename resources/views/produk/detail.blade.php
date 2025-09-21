@include('layout.head')
@include('layout.header')

<div class="bg-gray-100 min-h-screen py-8 px-4 pt-20"> 
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-6">
            <!-- Bagian Kiri: Gambar & Detail Produk -->
            <div class="lg:col-span-2 flex flex-col">
                <div class="bg-gray-200 rounded-lg relative mb-4 w-full aspect-[4/3] overflow-hidden flex items-center justify-center">
    <img src="{{ asset('admin/upload/produk/'.$product->gambar) }}" 
         alt="{{ $product->nama }}" 
         class="w-full h-full object-cover">
    
    @if($product->discount)
    <div class="absolute left-2 top-2 bg-pink-500 text-white text-xs font-semibold px-2 py-1 rounded shadow">
        {{ $product->discount }}%
    </div>
    @endif
</div>

                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->nama }}</h1>
                <div class="flex items-center mb-4">
                    <span class="text-green-600 font-medium mr-3">Terjual 50+</span>
                    <div class="flex items-center text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="text-gray-600 ml-2">4.7 (19 rating)</span>
                </div>

                <div class="mb-6">
                    <span class="text-3xl font-bold text-gray-800"> Rp{{ number_format($product->harga, 0, ',', '.') }}</span>
                </div>

                <div class="w-full h-px bg-gray-200 my-4"></div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail</h3>
                    <div class="space-y-2 text-sm text-gray-700">
                        <div class="flex">
                            <span class="w-40 font-medium">Kondisi:</span>
                            <span>{{ $product->kondisi }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-40 font-medium">Warna:</span>
                            <span>{{ $product->warna }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-40 font-medium">Min. Pemesanan:</span>
                            <span>1 Buah</span>
                        </div>
                        <div class="flex">
                            <span class="w-40 font-medium">Kategori:</span>
                            <span>{{ optional($product->category)->nama ?? 'Tidak Ada Kategori' }}</span>
                        </div>
                        <div class="flex">
                            <span class="w-40 font-medium">Garansi:</span>
                            <span>{{ $product->garansi }}</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4 class="font-medium text-gray-800 mb-2">Deskripsi</h4>
                        <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                            {!! $product->keterangan !!}
                        </ul>
                    </div>
                </div>
                <form class="add-to-cart-form" data-id="{{ $product->id_produk }}">
                    @csrf
                    <button type="submit" 
                        class="w-aspect-[1/2] bg-teal-600 text-white py-2 px-3 rounded-lg text-sm hover:bg-teal-700">
                        + Beli
                    </button>
                </form>
                <!-- Tombol Keranjang -->
                <div class="fixed bottom-0 left-0 w-full flex justify-center pb-4 z-50">
                <button onclick="toggleCart()" 
                    class="flex items-center gap-2 bg-amber-200 hover:bg-amber-300 text-black px-6 py-3 rounded-xl shadow-md transition">
                    <i class="fas fa-shopping-cart"></i> Keranjangku (<span id="cartCount">0</span>)
                </button>
                </div>

                <!-- Modal Keranjang -->
                <div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-end sm:items-center sm:justify-center z-50">
                <div class="bg-white rounded-t-2xl sm:rounded-xl shadow-lg w-full sm:w-[600px] max-h-[90vh] overflow-y-auto p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-shopping-cart mr-3 text-blue-600"></i>Keranjangku
                        </h2>
                        <button onclick="toggleCart()" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
                    </div>

                    <!-- Cart Items -->
                    <div id="cartItems" class="space-y-4">
                        <!-- Items akan di-render di sini -->
                    </div>

                    <!-- Total & Checkout -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-lg font-medium text-gray-700">Total</span>
                            <span id="cartTotal" class="text-xl font-bold text-blue-600">Rp0</span>
                        </div>

                        <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors flex items-center justify-center">
                            <i class="fas fa-check-circle mr-2"></i>Checkout Sekarang
                        </button>

                        <button class="w-full mt-3 border border-blue-600 text-blue-600 py-3 rounded-lg font-medium hover:bg-blue-50 transition-colors flex items-center justify-center">
                            <i class="fas fa-plus-circle mr-2"></i>Tambah Item Lainnya
                        </button>
                    </div>
                </div>
                </div>
            </div>

            <!-- Bagian Kanan: 5 Produk Terbaru -->
            <div class="flex flex-col">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Produk Terbaru</h2>
                <div class="space-y-4">
                    @foreach($latestProducts as $latest)
                    <div class="flex bg-gray-50 p-3 rounded-lg shadow hover:shadow-md transition">
                        <img src="{{ asset('admin/upload/produk/'.$latest->gambar) }}" 
                             alt="{{ $latest->nama }}" class="w-16 h-16 object-cover rounded mr-3">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800 text-sm">{{ Str::limit($latest->nama, 25, '...') }}</h3>
                            <span class="text-gray-600 text-sm">Rp{{ number_format($latest->harga,0,',','.') }}</span>
                        </div>
                        <a href="{{ route('produk.detail', $latest->id_produk) }}" 
                           class="text-blue-600 text-sm font-medium flex items-center">
                            Lihat <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>


@include('layout.footer')
