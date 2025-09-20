<p class="text-right">
	<a href="{{ asset('administrator/produk') }}" class="btn btn-outline-info btn-sm">
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
<form action="{{ asset('administrator/produk/proses-tambah') }}" enctype="multipart/form-data" method="post" accept-charset="utf-8">
{{ csrf_field() }}
<input type="hidden" name="csrf_test_name" value="155e3af88478230f860a934020e9214a">

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Nama</label>
                    <div class="col-md-9">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Produk" value="{{ old('nama') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right p-0">Kategori Produk</label>
                    <div class="col-md-9">
                        @if(isset($category) && count($category) > 0)
                            <select name="category_id" class="form-control" required>
                               <option value="" disabled selected>-- Pilih Tipe --</option>
                                @foreach ($category as $cat)
                                    <option value="{{ $cat->id_category }}">{{ $cat->nama }}</option>
                                @endforeach
                            </select>
                        @else
                            <p class="text-danger">Data Tipe tidak tersedia.</p>
                        @endif
                    </div>
                </div>

                <div class="form-group row text-right">
                    <label class="col-md-3 form-label p-0 mb-3">Status</label>
                    <div class="col-md-9">
                    <select name="status" class="form-control" required>
                        <option value="" disabled selected>Pilih Status</option>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Kosong">Kosong</option>
                    </select>
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-md-3 text-right">Deskripsi Produk</label>
                    <div class="col-md-9">
                        <textarea id="editor" name="keterangan" required>{{ old('keterangan') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Harga</label>
                    <div class="col-md-9">
                        <input type="text" name="harga" class="form-control" placeholder="Harga" value="{{ old('harga') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Kondisi</label>
                    <div class="col-md-9">
                        <input type="text" name="kondisi" class="form-control" placeholder="Kondisi Produk" value="{{ old('kondisi') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Warna</label>
                    <div class="col-md-9">
                        <input type="text" name="warna" class="form-control" placeholder="Warna Produk" value="{{ old('warna') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Garansi</label>
                    <div class="col-md-9">
                        <input type="text" name="garansi" class="form-control" placeholder="Garansi Produk" value="{{ old('garansi') }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 text-right">Upload Foto Produk</label>
                    <div class="col-md-6">
                    <input type="file" name="gambar" class="form-control" placeholder="Upload Foto" value="{{ old('gambar') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right"></label>
                    <div class="col-md-9">
                        <div class="form-group pull-right btn-group">
							<button class="btn btn-success" type="submit" name="submit" value="submit">
								<i class="fa fa-save"></i>Simpan Data User
							</button>
                            <input type="reset" name="reset" class="btn btn-danger " value="Reset">

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </form>