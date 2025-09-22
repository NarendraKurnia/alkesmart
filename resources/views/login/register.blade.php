<div class="w-full max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-6">
    <!-- Tombol Kembali -->
    <div class="text-right mb-4">
        <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 border border-blue-600 rounded hover:bg-blue-50">
            <i class="fa fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ asset('register/proses-tambah') }}" method="post" enctype="multipart/form-data" class="space-y-4">
        {{ csrf_field() }}

        <!-- Nama Lengkap -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Nama Lengkap</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Email -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Username -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Password -->
        <div>
            <label class="block mb-1 font-medium text-gray-700">Password</label>
            <input type="password" name="password" value="{{ old('password') }}" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Konfirmasi Password</label>
            <input type="password" name="konfirmasi_password" value="{{ old('konfirmasi_password') }}" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Tanggal Lahir</label>
            <input type="date" name="lahir" value="{{ old('lahir') }}" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="gender" class="form-control" required>
                        <option value="" disabled selected>Pilih</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                    </select>
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">ID Paypal</label>
            <input type="text" name="id_paypal" value="{{ old('id_paypal') }}" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label class="block mb-1 font-medium text-gray-700">Nama Bank</label>
            <input type="text" name="nama_bank" value="{{ old('nama_bank') }}" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        

        <div>
            <label class="block mb-1 font-medium text-gray-700">Alamat</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Kota</label>
            <input type="text" name="kota" value="{{ old('kota') }}" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Nomor Handphone</label>
            <input type="text" name="kontak" value="{{ old('kontak') }}" placeholder="Password" required
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Tombol Submit & Reset -->
        <div class="flex justify-end space-x-2 mt-4">
            <button type="submit" name="submit" value="submit"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 flex items-center">
                <i class="fa fa-save mr-2"></i> Simpan Data User
            </button>
            <button type="reset"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Reset</button>
        </div>
    </form>
</div>
