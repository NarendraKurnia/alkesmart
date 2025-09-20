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
<form action="{{ asset('administrator/produk/proses-edit') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_produk"	value="{{ $produk->id_produk }}">
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Nama Produk</label>
                    <div class="col-md-9">
                        <input type="text" name="nama" class="form-control" placeholder="Judul" value="{{ $produk->nama }}">
                    </div>
                </div>

                <div class="form-group row"> 
    <label class="col-md-3 control-label text-right p-0">Kategori Produk</label>
    <div class="col-md-9">
        @if(isset($category) && count($category) > 0)
            <select name="category_id" class="form-control" required>
    <option value="" disabled {{ old('category_id', $produk->category_id ?? '') ? '' : 'selected' }}>-- Pilih Tipe --</option>
    @foreach ($category as $cat)
        <option value="{{ $cat->id_category }}" 
            {{ old('category_id', $produk->category_id ?? '') == $cat->id_category ? 'selected' : '' }}>
            {{ $cat->nama }}
        </option>
    @endforeach
</select>

        @else
            <p class="text-danger">Data Tipe tidak tersedia.</p>
        @endif
    </div>
</div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Deskripsi produk</label>
                    <div class="col-md-9">
                        <textarea class="editor" name="keterangan" class="form-control">{!! old('keterangan', $produk->keterangan) !!}</textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Harga</label>
                    <div class="col-md-9">
                        <input type="text" name="harga" class="form-control" placeholder="Harga" value="{{ $produk->harga }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Kondisi Produk</label>
                    <div class="col-md-9">
                        <input type="text" name="kondisi" class="form-control" placeholder="Kondisi Produk" value="{{ $produk->kondisi }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Warna Produk</label>
                    <div class="col-md-9">
                        <input type="text" name="warna" class="form-control" placeholder="Warna Produk" value="{{ $produk->warna }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Garansi Produk</label>
                    <div class="col-md-9">
                        <input type="text" name="garansi" class="form-control" placeholder="Garansi Produk" value="{{ $produk->garansi }}">
                    </div>
                </div>

                <div class="form-group row text-right">
                    <label class="col-md-3 form-label p-0 mb-3">Status Produk</label>
                    <div class="col-md-9">
                    <select name="status" class="form-control" required>
                        <option value="" disabled selected>Pilih Status</option>
                                    <option value="Tersedia"{{ old('status', $produk->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Kosong" {{ old('status', $produk->status) == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                    </select>
                    </div>
                </div>  

                <div class="form-group row">
                    <label class="col-sm-3 control-label text-right">Update Foto Buletin</label>
                    <div class="col-sm-9">
                        <input type="file" name="gambar" class="form-control" placeholder="Upload Foto" value="{{ old('gambar') }}">
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