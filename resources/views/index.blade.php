@include('layout.head')
@include('layout.header')
@if(count($banner) > 0)
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" style="margin-top: 18px;">
    <div class="carousel-indicators">
        @foreach($banner as $index => $item)
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner carousel-inner-utama">
        @foreach($banner as $index => $item)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('admin/upload/banner/' . $item->gambar) }}" class="d-block w-100" alt="{{ $item->judul }}">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
@endif

<body class="bg-white text-gray-800 pt-12">
  <section class="py-4">
  <div class="bg-white py-6 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-6 items-center justify-items-center">
        
        <!-- Logo Daihatsu -->
        <img src="{{ asset('umum/images/onemed.png') }}" 
             alt="Daihatsu" 
             class="h-10 object-contain" />

        <!-- Logo Toyota -->
        <img src="{{ asset('umum/images/logo-serenity.png') }}" 
             alt="Toyota" 
             class="h-10 object-contain" />

        <!-- Logo Ooredoo -->
        <img src="{{ asset('umum/images/logo-jaya-medika.png') }}" 
             alt="Ooredoo" 
             class="h-10 object-contain" />

        <!-- Logo Telkomsel -->
        <img src="{{ asset('umum/images/logo-abn.png') }}" 
             alt="Telkomsel" 
             class="h-10 object-contain" />

        <!-- Logo Mitsubishi -->
        <img src="{{ asset('umum/images/icon-Karindo_Alkestron.png') }}" 
             alt="Mitsubishi" 
             class="h-10 object-contain" />

        <!-- Logo Honda -->
        <img src="{{ asset('umum/images/logo-indolab.png') }}" 
             alt="Honda" 
             class="h-10 object-contain" />

      </div>
    </div>
  </div>
</section>
<div class="bg-gray-100 pb-20 py-8 px-4">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">KATEGORI</h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @forelse ($categories as $cat)
                <a href="{{ route('produk.category', $cat->slug) }}" class="category-card bg-white rounded-lg p-4 text-center shadow hover:shadow-lg transition duration-300">
                    <div class="w-20 h-20 mx-auto mb-2 flex items-center justify-center">
                        @if($cat->gambar)
                            <img src="{{ asset('admin/upload/category/'.$cat->gambar) }}" alt="{{ $cat->nama }}" class="w-full h-full object-cover rounded-full">
                        @else
                            <div class="w-full h-full bg-gray-200 rounded-full flex items-center justify-center">
                                <i class="fas fa-folder text-gray-500"></i>
                            </div>
                        @endif
                    </div>
                    <p class="text-sm font-medium text-gray-800">{{ $cat->nama }}</p>
                </a>
            @empty
                <p class="col-span-full text-center text-gray-500">Kategori tidak tersedia.</p>
            @endforelse
        </div>
    </div>
</div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Header / Tabs -->
    <div class="flex items-center justify-between mb-6">
      <div class="flex space-x-6 items-end">
        <button class="text-teal-600 font-semibold border-b-2 border-teal-600 pb-1">For You</button>
        <button class="text-gray-600">Produk Incaranmu</button>
      </div>

      <div class="text-sm text-gray-500">
        Menampilkan <span class="font-medium text-gray-700">{{ $products->count() }}</span> produk
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
  </div>
@include('layout.footer')
