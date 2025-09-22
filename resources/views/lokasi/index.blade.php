@include('layout.head')
@include('layout.header')
<div class="bg-gray-50 p-6 pt-24">
<!-- lokasi -->
  <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6">
  <!-- Judul -->
  <h2 class="text-xl font-semibold text-gray-800 mb-4">
    Info Lokasi Alkesmart
  </h2>

  <!-- Layout Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    <!-- Peta -->
    <div class="space-y-3">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d64869.63168315314!2d112.7983668930742!3d-7.33408677483597!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fab87edcad15%3A0xb26589947991eea1!2sUniversitas%20Pembangunan%20Nasional%20%22Veteran%22%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1758513841949!5m2!1sid!2sid"
        class="w-full h-80 md:h-96 rounded-lg border border-gray-200"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
      <div class="flex flex-col md:flex-row gap-4">
        <a href="https://maps.app.goo.gl/duxnZzf4bCrtwSc88" target="_blank"
          class="flex items-center justify-center gap-2 w-full md:w-64 px-4 py-2 bg-gray-800 text-white text-sm rounded-md shadow hover:bg-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 20l-5.447-2.724A2 2 0 013 15.382V5.618a2 2 0 011.553-1.894L9 1m0 0l6 3m-6-3v19m6-16l5.447 2.724A2 2 0 0121 8.618v9.764a2 2 0 01-1.553 1.894L15 23m0-19v19" />
          </svg>
          Buka Via Google Maps
        </a>
      </div>


      <p class="text-sm text-gray-600 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414a4 4 0 00-5.657 0L2 18.172M15 10h.01M21 21l-6-6" />
        </svg>
        Jl. Rungkut Madya, Gn. Anyar, Kec. Gn. Anyar, Surabaya, Jawa Timur 60294
      </p>

      <!-- Contact Person -->
      <div class="mt-4 space-y-2">
  <h3 class="font-semibold text-gray-800">Hubungi Kami</h3>
  <div class="flex flex-wrap items-center gap-3">
    <!-- WhatsApp -->
    <a href="https://wa.me/6281234567890" target="_blank" 
      class="flex items-center gap-2 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
      <i class="fab fa-whatsapp text-xl"></i>
      <span>WhatsApp</span>
    </a>

    <!-- Instagram -->
    <a href="https://instagram.com/username" target="_blank" 
      class="flex items-center gap-2 bg-pink-500 text-white px-4 py-2 rounded-lg shadow hover:bg-pink-600 transition">
      <i class="fab fa-instagram text-xl"></i>
      <span>Instagram</span>
    </a>
  </div>
</div>
</div>

      <!-- Informasi -->
      <div class="space-y-4">
        <!-- Tag lokasi -->
        <div class="flex flex-wrap gap-2">
          <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm rounded-md flex items-center gap-1">
            🔒 Kawasan perbelanjaan
          </span>
          <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm rounded-md flex items-center gap-1">
            🎡 Dekat tempat rekreasi
          </span>
          <span class="px-3 py-1 bg-blue-50 text-blue-700 text-sm rounded-md flex items-center gap-1">
            🏬 Dekat Tunjungan Plaza
          </span>
        </div>

        <!-- Di Sekitar Properti -->
        <div>
          <h3 class="font-semibold text-gray-800 mb-2">Di Sekitar Properti</h3>
          <ul class="space-y-2 text-sm">
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🟢 Gereja Bethany Mandarin
                <span class="text-gray-500">Tempat Suci & Religius</span>
              </span>
              <span>122 m</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                💼 ATM BNI
                <span class="text-gray-500">Bisnis</span>
              </span>
              <span>187 m</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                ➕ Gleneagles Diagnostic Center
                <span class="text-gray-500">Layanan Publik</span>
              </span>
              <span>393 m</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🚉 Stasiun Surabaya Gubeng
                <span class="text-gray-500">Pusat Transportasi</span>
              </span>
              <span>1.20 km</span>
            </li>
          </ul>
        </div>

        <!-- Populer -->
        <div>
          <h3 class="font-semibold text-gray-800 mb-2">Populer di Area Ini</h3>
          <ul class="space-y-2 text-sm">
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🚌 Stasiun Pasar Turi
                <span class="text-gray-500">Pusat Transportasi</span>
              </span>
              <span>2.46 km</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🛍️ Tunjungan Plaza
                <span class="text-gray-500">Pusat Hiburan</span>
              </span>
              <span>500 m</span>
            </li>
            <li class="flex items-center justify-between">
              <span class="flex items-center gap-2">
                🎓 Universitas Airlangga
                <span class="text-gray-500">Lainnya</span>
              </span>
              <span>1.99 km</span>
            </li>
          </ul>
        </div>

        <!-- Catatan -->
        <p class="text-xs text-gray-500">
          ⚠️ Jarak dihitung berdasarkan garis lurus. Jarak sebenarnya dapat bervariasi.
        </p>
      </div>
    </div>
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6 mt-8">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Guestbook</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Guestbook -->
<form action="{{ route('lokasi.guestbook.store') }}" method="POST" class="space-y-4 mb-6">
    @csrf
    <input type="text" name="nama" placeholder="Nama Anda" required class="border rounded px-3 py-2 w-full">
    <textarea name="keterangan" placeholder="Tulis pesan Anda..." required class="border rounded px-3 py-2 w-full"></textarea>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Kirim
    </button>
</form>

<div class="space-y-4">
    @foreach($guestbookEntries as $entry)
        <div class="p-3 border rounded bg-gray-50">
            <p class="font-semibold">{{ $entry->nama }}</p>
            <p>{{ $entry->keterangan }}</p>
            <p class="text-xs text-gray-400">{{ date('d M Y H:i', strtotime($entry->created_at)) }}</p>
        </div>
    @endforeach
</div>

  </div>
</div>
</div>
</div>

@include('layout.footer')
