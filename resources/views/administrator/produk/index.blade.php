@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <form action="{{ url('administrator/produk') }}" method="get">
        <div class="input-group">
            <input type="text" name="keywords" class="form-control" placeholder="Cari produk..." value="{{ request('keywords') }}">
            <span class="input-group-append">
                <button type="submit" class="btn btn-info btn-flat">
                    <i class="fa fa-search"></i> Cari
                </button>
                <a href="{{ url('administrator/produk/tambah') }}" class="btn btn-success">
                    <i class="fa fa-plus"></i> Tambah Baru
                </a>
            </span>
        </div>
    </form>
    </div>
    
    <div class="col-md-6">
    {{ $produk->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </div>
</div>

<hr>

<div class="table-responsive mailbox-messages mt-1">        
<table class="table table-sm table-hover" id="example2">
    <thead>
        <tr class="text-left bg-light">
            <th width="10%" class="text-center">NO</th>
            <th width="10%">Nama Produk</th>
            <th width="25%">Kategori Produk</th>
            <th width="20%">Status</th>
            <th width="15%">Update</th>
            <th width="20%">Action</th>
        </tr>
    </thead>
    <tbody>
    @php $no = ($produk->currentPage() - 1) * $produk->perPage() + 1; @endphp
        @foreach($produk as $item)
        <tr>
            <td class="text-center">{{ $no }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ optional($item->category)->nama ?? 'Tidak ada category' }}</td>
            <td>{{ $item->status }}</td>
            <td>
            {{ \Carbon\Carbon::parse($item->tanggal_update, 'Asia/Jakarta')
                ->setTimezone('Asia/Jakarta')
                ->format('d-m-Y H:i:s') }}
            </td>
            <td>
                <div class="btn-group">
                    <a href="{{ asset('administrator/produk/edit/'.$item->id_produk) }}" 
                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target={{"#exampleModal1" . $item->id_produk}}>
                    <i class="fa fa-eye"></i>
                    @php
                        $unit_id = session('pegawai_id');
                    @endphp

                    @if ($unit_id != 1)
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{ '#exampleModal2' . $item->id_produk }}"> 
                        <i class="fa fa-trash"></i>
                    </button>
                    @endif
                </button>
                <a href="{{ route('user', $item->id_produk) }}" target="_blank" class="btn btn-success btn-sm">
                    <i class="fa fa-print"></i>
                </a>

                <!-- Modal Detail Shift -->
                    <div class="modal fade" id="{{ 'exampleModal1' . $item->id_produk }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id_kamar }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel{{ $item->id_produk }}">Detail Kamar </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="row">

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label mb-3">Nama Produk</label>
                                <input type="text" name="nama" class="form-control shadow-none" value="{{ $item->nama }}" readonly>
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label p-0 mb-3">Kategori Produk</label>
                                <input type="text" class="form-control shadow-none" value="{{ optional($item->category)->nama ?? 'Tidak Ada Kategori' }}" readonly>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label mb-3">Harga</label>
                                <input type="text" class="form-control shadow-none" value="{{ $item->harga }}" readonly>
                            </div>

                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label p-0 mb-3">Kondisi</label>
                                <input type="text" class="form-control shadow-none" value="{{ $item->kondisi }}" readonly>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label mb-3">Warna</label>
                                <input type="text" class="form-control shadow-none" value="{{ $item->warna }}" readonly>
                            </div>

                            <div class="col-md-6 p-0 mb-3">
                                <label class="form-label p-0 mb-3">Garansi</label>
                                <input type="text" class="form-control shadow-none" value="{{ $item->garansi }}" readonly>
                            </div>

                            <div class="col-md-6 ps-0 mb-3">
                                <label class="form-label ps-0 mb-3">Status Produk</label>
                                <input type="text" class="form-control shadow-none" value="{{ $item->status }}" readonly>
                            </div>

                            <div class="col-md-12 ps-0 mb-3">
                                <label class="form-label mb-3">Keterangan</label>
                               <div class="border p-3 rounded bg-light" style="min-height: 80px;">
                                {!! $item->keterangan ?? '<em>Tidak ada keterangan</em>' !!}
                            </div>
                            <div class="col-md-12 ps-0 mb-3 mt-4">
                                <label class="form-label mb-3">Foto Produk:</label>
                            @if($item->gambar)
                                    <img src="{{ asset('admin/upload/produk/'.$item->gambar) }}" 
                                        class="img img-fluid img-thumbnail" 
                                        alt="Gambar {{ $item->nama }}" 
                                        style="max-width: 200px;">
                            @else
                                    <span class="badge badge-warning">Tidak ada</span>
                            @endif
                            </div>

                            </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>


                <!-- Modal 2-->
                <div class="modal fade" id={{"exampleModal2" . $item->id_produk}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Data Yang di Hapus Tidak Dapat Dikembalikan!!!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('produk.delete', $item->id_produk) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus Data</button>
                        </form>
                    </div>
                    </div>
                </div>
            </td>
        </tr>
        @php $no++; @endphp
        @endforeach
    </tbody>
</table>
</div>



