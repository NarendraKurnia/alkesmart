<header class="fixed top-0 left-0 w-full bg-dark bg-opacity-80 text-white text-sm md:text-base z-50 shadow">
  <nav class="max-w-7xl mx-auto px-6 flex justify-between items-center py-3 gap-5 text-base">
    <!-- Logo / Kiri -->
    <div class="flex items-center gap-3">
      <div class="flex items-center gap-1">
        <svg role="img" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16">
          <path d="..." />
        </svg>
        <a href="{{ route('home.index') }}" class="underline hover:text-gray-300 whitespace-nowrap">Back to Mora Group</a>
      </div>
    </div>

    <!-- Menu utama (desktop) -->
    <div class="hidden md:flex items-center gap-4">
      <a href="{{ route('home.index') }}" class="hover:underline">Fasilitas</a>
      <a href="{{ route('home.index') }}" class="hover:underline">Lokasi & Kontak</a>
      <select class="bg-transparent text-white font-semibold focus:outline-none hover:text-gray-300 cursor-pointer">
        <option class="text-black" value="id">Indonesia</option>
        <option class="text-black" value="en">English</option>
      </select>
      @auth
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 opacity-80">
            <i class="fas fa-user"></i>
        </span>
        <span class="ml-8 text-white font-semibold">
            {{ Auth::user()->name ?? Auth::user()->email }}
        </span>
      @else
        <a href="{{ route('home.index') }}" 
            class="bg-white text-black rounded px-4 py-1 hover:bg-gray-200 transition font-semibold inline-block">
            Login
        </a>
      @endauth
    </div>

    <!-- Tombol hamburger (mobile) -->
    <button id="menu-toggle" class="md:hidden flex flex-col gap-1">
      <span class="w-6 h-0.5 bg-white"></span>
      <span class="w-6 h-0.5 bg-white"></span>
      <span class="w-6 h-0.5 bg-white"></span>
    </button>
  </nav>

  <!-- Menu mobile -->
  <div id="mobile-menu" class="hidden flex flex-col items-center gap-3 py-4 border-t border-gray-500 md:hidden bg-dark bg-opacity-90">
    <a href="{{ route('home.index') }}" class="hover:underline">Fasilitas</a>
    <a href="{{ route('home.index') }}" class="hover:underline">Lokasi & Kontak</a>
    <select class="bg-transparent text-white font-semibold focus:outline-none hover:text-gray-300 cursor-pointer">
      <option class="text-black" value="id">Indonesia</option>
      <option class="text-black" value="en">English</option>
    </select>
    <a href="{{ route('home.index') }}" 
      class="bg-white text-black rounded px-4 py-1 hover:bg-gray-200 transition font-semibold inline-block">
      Login
    </a>
  </div>
</header>