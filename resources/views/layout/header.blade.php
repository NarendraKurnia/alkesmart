<header class="fixed top-0 left-0 w-full bg-dark bg-opacity-80 text-white text-sm md:text-base z-50 shadow">
  <nav class="max-w-7xl mx-auto px-6 flex justify-between items-center py-3 gap-5 text-base">
    <!-- Logo / Kiri -->
    <div class="flex items-center gap-3">
      <div class="flex items-center gap-1">
        <svg role="img" xmlns="http://www.w3.org/2000/svg" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" width="16" height="16">
          <path d="..." />
        </svg>
        <a href="{{ route('home.index') }}" class="underline hover:text-gray-300 whitespace-nowrap">Alkesmart</a>
      </div>
    </div>

    {{-- Desktop --}}
<div class="hidden md:flex items-center gap-4">
    <a href="{{ route('lokasi') }}" class="hover:underline">Lokasi & Kontak</a>

    <select class="bg-transparent text-white font-semibold focus:outline-none hover:text-gray-300 cursor-pointer">
        <option class="text-black" value="id">Indonesia</option>
        <option class="text-black" value="en">English</option>
    </select>

    @if(Session::has('nama'))
        {{-- User sudah login --}}
        <div class="relative inline-block text-black">
            <button class="flex items-center space-x-2 px-4 py-1 rounded bg-white hover:bg-gray-100 font-semibold"
                    id="user-menu-button-desktop">
                <i class="fa fa-user"></i>
                <span>{{ Session::get('nama') }}</span>
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-md hidden" id="user-dropdown-desktop">
                <a href="{{ route('home.index') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
            </div>
        </div>
    @else
        {{-- Belum login --}}
        <a href="{{ route('login') }}" class="bg-white text-black rounded px-4 py-1 hover:bg-gray-200 transition font-semibold inline-block">
            Login
        </a>
    @endif
</div>

{{-- Mobile --}}
<div id="mobile-menu" class="hidden flex flex-col items-center gap-3 py-4 border-t border-gray-500 md:hidden bg-dark bg-opacity-90">
    <a href="{{ route('lokasi') }}" class="hover:underline">Lokasi & Kontak</a>

    <select class="bg-transparent text-white font-semibold focus:outline-none hover:text-gray-300 cursor-pointer">
        <option class="text-black" value="id">Indonesia</option>
        <option class="text-black" value="en">English</option>
    </select>

    @if(Session::has('nama'))
        {{-- User sudah login --}}
        <div class="relative inline-block">
            <button class="flex items-center space-x-2 px-4 py-1 rounded bg-white hover:bg-gray-100 font-semibold"
                    id="user-menu-button-mobile">
                <i class="fa fa-user"></i>
                <span>{{ Session::get('nama') }}</span>
                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-md hidden" id="user-dropdown-mobile">
                <a href="{{ route('home.index') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
            </div>
        </div>
    @else
        {{-- Belum login --}}
        <a href="{{ route('login') }}" class="bg-white text-black rounded px-4 py-1 hover:bg-gray-200 transition font-semibold inline-block">
            Login
        </a>
    @endif
</div>


  <script>
    // Toggle desktop dropdown
    const btnDesktop = document.getElementById('user-menu-button-desktop');
    const menuDesktop = document.getElementById('user-dropdown-desktop');
    if(btnDesktop){
        btnDesktop.addEventListener('click', () => {
            menuDesktop.classList.toggle('hidden');
        });
    }

    // Toggle mobile dropdown
    const btnMobile = document.getElementById('user-menu-button-mobile');
    const menuMobile = document.getElementById('user-dropdown-mobile');
    if(btnMobile){
        btnMobile.addEventListener('click', () => {
            menuMobile.classList.toggle('hidden');
        });
    }

    // Toggle mobile menu hamburger
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    menuToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
  </script>
</header>
