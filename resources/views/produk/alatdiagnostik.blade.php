<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header / Tabs -->
    <div class="flex items-center justify-between mb-6">
      <div class="flex space-x-6 items-end">
        <button class="text-teal-600 font-semibold border-b-2 border-teal-600 pb-1">For You</button>
        <button class="text-gray-600">Produk Incaranmu</button>
      </div>

      <div class="text-sm text-gray-500">
        Menampilkan <span class="font-medium text-gray-700">24</span> produk
      </div>
    </div>

    <!-- Grid Produk -->
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
@foreach($products as $product)
    <div class="group">
        <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition relative">
            <div class="relative">
                <img src="{{ asset('admin/upload/produk/'.$product->gambar) }}" 
                     alt="{{ $product->nama }}" 
                     class="w-full h-48 object-cover card-image">
                @if($product->discount)
                    <div class="absolute left-2 top-2 bg-pink-500 text-white text-xs font-semibold px-2 py-1 rounded shadow">
                        {{ $product->discount }}%
                    </div>
                @endif
            </div>
            <div class="p-3">
                <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">
    <a href="{{ route('produk.detail', $product->id_produk) }}" class="hover:text-blue-600 transition-colors">
        {{ \Illuminate\Support\Str::limit($product->nama, 50, ' ...') }}
    </a>
</h3>
                <div class="flex items-baseline justify-between">
                    <div>
                        <div class="text-lg font-bold text-gray-900">
                            Rp{{ number_format($product->harga, 0, ',', '.') }}
                        </div>
                        @if($product->price_before)
                            <div class="text-xs text-gray-500 line-through">
                                Rp{{ number_format($product->price_before, 0, ',', '.') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-3 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="flex items-center text-yellow-400 text-sm">
                            <svg class="w-4 h-4 mr-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.566-.955L10 0l2.944 5.955 6.566.955-4.755 4.634 1.123 6.545z"/>
                            </svg>
                            <span class="text-xs font-semibold text-gray-700">
                                {{ number_format(rand(45,50)/10, 1) }}
                            </span>
                        </div>
                        <div class="text-xs text-gray-500">
                            • {{ rand(100, 9000) }}+ terjual
                        </div>
                    </div>
                    <div class="text-xs text-teal-600 font-medium">
                        {{ $product->brand ?? 'Toko Kami' }}
                    </div>
                </div>

                <form class="add-to-cart-form" data-id="{{ $product->id_produk }}">
                    @csrf
                    <button type="submit" 
                        class="w-full bg-teal-600 text-white py-2 px-3 rounded-lg text-sm hover:bg-teal-700">
                        + Beli
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>