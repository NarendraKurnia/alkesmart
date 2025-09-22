<p class="text-right">
	<a href="{{ asset('administrator/users') }}" class="btn btn-outline-info btn-sm">
		<i class="fa fa-arrow-left"></i> Kembali
	</a>
</p>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ asset('administrator/users/proses-tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Nama lengkap</label>
                    <div class="col-md-9">
                        <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" value="{{ old('nama') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Email</label>
                    <div class="col-md-9">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>              

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Username</label>
                    <div class="col-md-9">
                        <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Password</label>
                    <div class="col-md-9">
                        <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Konfirmasi Password</label>
                    <div class="col-md-9">
                        <input type="password" name="konfirmasi_password" class="form-control" placeholder="Password" value="{{ old('konfirmasi_password') }}" required>
                    </div>
                </div> 
                
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Tanggal Lahir</label>
                    <div class="col-md-9">
                        <input type="date" name="lahir" class="form-control" placeholder="Tanggal Lahir" value="{{ old('lahir') }}" required>
                    </div>
                </div> 

                <div class="form-group row">
                    
                    <label class="col-md-3 control-label text-right">Gender</label>
                    <div class="col-md-9">
                        <select name="gender" class="form-control" required>
                        <option value="" disabled selected>Pilih</option>
                                    <option value="Pria">Pria</option>
                                    <option value="Wanita">Wanita</option>
                    </select>
                    </div>
                </div> 

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Alamat</label>
                    <div class="col-md-9">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ old('alamat') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">ID Paypal</label>
                    <div class="col-md-9">
                        <input type="text" name="id_paypal" class="form-control" placeholder="ID Paypal" value="{{ old('id_paypal') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Nama Bank</label>
                    <div class="col-md-9">
                        <input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank" value="{{ old('nama_bank') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Kota</label>
                    <div class="col-md-9">
                        <input type="text" name="kota" class="form-control" placeholder="Kota" value="{{ old('kota') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Kontak</label>
                    <div class="col-md-9">
                        <input type="text" name="kontak" class="form-control" placeholder="Kontak" value="{{ old('kontak') }}" required>
                    </div>
                </div>

            </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right"></label>
                    <div class="col-md-9">
                        <div class="form-group pull-right btn-group">
							<button class="btn btn-success" type="submit" name="submit" value="submit">
								<i class="fa fa-save"></i>Simpan Data User Public
							</button>
                            <input type="reset" name="reset" class="btn btn-danger " value="Reset">

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </form>