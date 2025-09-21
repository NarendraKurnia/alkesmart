<p class="text-right">
	<a href="{{ asset('administrator/category') }}" class="btn btn-outline-info btn-sm">
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
<form action="{{ asset('administrator/category/proses-edit') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
{{ csrf_field() }}

<input type="hidden" name="id_category"	value="{{ $category->id_category }}">
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Nama Kategori</label>
                    <div class="col-md-9">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Kategori" value="{{ $category->nama }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 control-label text-right">Link Category</label>
                    <div class="col-md-9">
                        <input type="text" name="slug" class="form-control" placeholder="Link Kategori" value="{{ $category->slug }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label text-right">Update Foto Category</label>
                    <div class="col-sm-9">
                        <input type="file" name="gambar" class="form-control" placeholder="Upload Foto" value="{{ old('gambar') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 control-label text-right"></label>
                    <div class="col-md-9">
                        <div class="form-group pull-right btn-group">
							<button class="btn btn-success" type="submit" name="submit" value="submit">
								<i class="fa fa-save"></i>Simpan Data Category
							</button>
                            <input type="reset" name="reset" class="btn btn-danger " value="Reset">

                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </form>