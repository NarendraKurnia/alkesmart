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
  <div class="bg-white py-6">
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
      <!-- Card (ulang sesuai banyak produk) -->
      <!-- contoh 12 produk diisi statis; ganti loop jika di Blade -->
      <!-- Mulai kartu -->
      <div class="group">
        <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition relative">
          <!-- Image -->
          <div class="relative">
            <img src="https://via.placeholder.com/400x400.png?text=Product+1" alt="Produk 1" class="w-full card-image">
            <!-- Discount badge -->
            <div class="absolute left-2 top-2 bg-pink-500 text-white text-xs font-semibold px-2 py-1 rounded shadow">10%</div>
            <!-- Favorite small dots -->
            <div class="absolute right-2 top-2 flex space-x-1">
              <button class="bg-white/70 p-1 rounded-full hover:bg-white">
                <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20"><path d="M3.172 5.172A4 4 0 017 4h6a4 4 0 013.828 1.172 4 4 0 010 5.656L10 17 3.172 10.828a4 4 0 010-5.656z"/></svg>
              </button>
            </div>
          </div>

          <!-- Body -->
          <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">ADVAN Workplus AMD Ryzen ...</h3>

            <div class="flex items-baseline justify-between">
              <div>
                <div class="text-lg font-bold text-gray-900">Rp6.999.000</div>
                <div class="text-xs text-gray-500">Rp7.599.000</div>
              </div>
            </div>

            <div class="mt-3 flex items-center justify-between">
              <div class="flex items-center space-x-2">
                <div class="flex items-center text-yellow-400 text-sm">
                  <!-- star -->
                  <svg class="w-4 h-4 mr-0.5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.49 6.91l6.566-.955L10 0l2.944 5.955 6.566.955-4.755 4.634 1.123 6.545z"/></svg>
                  <span class="text-xs font-semibold text-gray-700">4.9</span>
                </div>
                <div class="text-xs text-gray-500">• 7rb+ terjual</div>
              </div>

              <div class="text-xs text-teal-600 font-medium">ADVAN INDONESIA</div>
            </div>
          </div>
        </div>
      </div>
      <!-- Akhir kartu -->

      <!-- Duplicate kartu (ganti data sesuai actual) -->
      <div class="group">
        <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition relative">
          <div class="relative">
            <img src="https://via.placeholder.com/400x400.png?text=Product+2" alt="Produk 2" class="w-full card-image">
            <div class="absolute left-2 top-2 bg-pink-500 text-white text-xs font-semibold px-2 py-1 rounded shadow">36%</div>
          </div>
          <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">HUAWEI WATCH GT 5 Series ...</h3>
            <div class="text-lg font-bold text-gray-900">Rp2.299.000</div>
            <div class="mt-3 flex items-center justify-between">
              <div class="text-xs text-gray-500">⭐ 5.0 • 7rb+ terjual</div>
              <div class="text-xs text-teal-600 font-medium">Huawei Indonesia</div>
            </div>
          </div>
        </div>
      </div>

      <!-- lebih banyak kartu... (copy/paste dan ubah gambar/teks/harga) -->
      <div class="group">
        <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition relative">
          <div class="relative">
            <img src="https://via.placeholder.com/400x400.png?text=Product+3" alt="Produk 3" class="w-full card-image">
            <div class="absolute left-2 top-2 bg-pink-500 text-white text-xs font-semibold px-2 py-1 rounded shadow">37%</div>
          </div>
          <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">Barber Daily Acne Care & Oil ...</h3>
            <div class="text-lg font-bold text-gray-900">Rp31.500</div>
            <div class="mt-3 flex items-center justify-between">
              <div class="text-xs text-gray-500">⭐ 4.8 • 1rb+ terjual</div>
              <div class="text-xs text-teal-600 font-medium">Zahra Karpasa Store</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="group">
        <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition relative">
          <div class="relative">
            <img src="https://via.placeholder.com/400x400.png?text=Product+4" alt="Product 4" class="w-full card-image">
            <div class="absolute left-2 top-2 bg-pink-500 text-white text-xs font-semibold px-2 py-1 rounded shadow">74%</div>
          </div>
          <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">(NEW LAUNCH) Soundcore ...</h3>
            <div class="text-lg font-bold text-gray-900">Rp289.000</div>
            <div class="mt-3 flex items-center justify-between">
              <div class="text-xs text-gray-500">⭐ 4.9 • 10rb+ terjual</div>
              <div class="text-xs text-teal-600 font-medium">Anker Indonesia</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="group">
        <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition relative">
          <div class="relative">
            <img src="https://via.placeholder.com/400x400.png?text=Product+5" alt="Product 5" class="w-full card-image">
            <div class="absolute left-2 top-2 bg-pink-500 text-white text-xs font-semibold px-2 py-1 rounded shadow">13%</div>
          </div>
          <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">HUAWEI MatePad SE 11" Table ...</h3>
            <div class="text-lg font-bold text-gray-900">Rp2.599.000</div>
            <div class="mt-3 flex items-center justify-between">
              <div class="text-xs text-gray-500">⭐ 4.9 • 3rb+ terjual</div>
              <div class="text-xs text-teal-600 font-medium">Huawei Indonesia</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card 6 -->
      <div class="group">
        <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition relative">
          <div class="relative">
            <img src="https://via.placeholder.com/400x400.png?text=Product+6" alt="Product 6" class="w-full card-image">
            <div class="absolute left-2 top-2 bg-orange-500 text-white text-xs font-semibold px-2 py-1 rounded shadow">COD</div>
          </div>
          <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">Lampu tenaga surya otomatis ...</h3>
            <div class="text-lg font-bold text-gray-900">Rp69.900</div>
            <div class="mt-3 flex items-center justify-between">
              <div class="text-xs text-gray-500">⭐ 4.9 • 9rb+ terjual</div>
              <div class="text-xs text-teal-600 font-medium">Edeen Mall</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Anda bisa copy-paste kartu di atas untuk menambah lebih banyak produk -->
      <!-- contoh duplikasi lain -->
      <div class="group">
        <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition relative">
          <div class="relative">
            <img src="https://via.placeholder.com/400x400.png?text=Product+7" alt="Product 7" class="w-full card-image">
            <div class="absolute left-2 top-2 bg-pink-500 text-white text-xs font-semibold px-2 py-1 rounded shadow">59%</div>
          </div>
          <div class="p-3">
            <h3 class="text-sm font-medium text-gray-900 line-clamp-2 mb-1">Promo 4 pcs celana pendek ...</h3>
            <div class="text-lg font-bold text-gray-900">Rp70.000</div>
            <div class="mt-3 flex items-center justify-between">
              <div class="text-xs text-gray-500">⭐ 4.5 • 1rb+ terjual</div>
              <div class="text-xs text-teal-600 font-medium">Store XYZ</div>
            </div>
          </div>
        </div>
      </div>

      <!-- ... tambahkan sesuai kebutuhan -->
    </div>

  </div>
@include('layout.footer')
