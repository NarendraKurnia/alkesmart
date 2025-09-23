@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row mb-3">
    <div class="col-md-6">
        <form action="{{ url('administrator/orders') }}" method="get">
            <div class="input-group">
                <input type="text" name="keywords" class="form-control" placeholder="Cari nama pelanggan..." value="{{ request('keywords') }}">
                <span class="input-group-append">
                    <button type="submit" class="btn btn-info btn-flat">
                        <i class="fa fa-search"></i> Cari
                    </button>
                    <a href="{{ url('administrator/orders/tambah') }}" class="btn btn-success btn-flat">
                        <i class="fa fa-plus"></i> Tambah Baru
                    </a>
                </span>
            </div>
        </form>
    </div>

    <div class="col-md-6 text-right">
        {{ $orders->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
    </div>
</div>

<hr>

<div class="table-responsive mailbox-messages mt-1">
    <table class="table table-sm table-hover" id="example2">
        <thead>
            <tr class="text-left bg-light">
                <th width="6%" class="text-center">NO</th>
                <th width="18%">Nama</th>
                <th width="15%">Kontak</th>
                <th width="24%">Alamat</th>
                <th width="10%">Status Bayar</th>
                <th width="10%">Status Kirim</th>
                <th width="12%">Tanggal</th>
                <th width="15%">Action</th>
            </tr>
        </thead>
        <tbody>
        @php $no = ($orders->currentPage() - 1) * $orders->perPage() + 1; @endphp
        @foreach($orders as $order)
            <tr>
                <td class="text-center">{{ $no }}</td>
                <td>{{ $order->nama }}</td>
                <td>{{ $order->kontak }}</td>
                <td>{{ Str::limit($order->alamat, 80, '...') }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>{{ ucfirst($order->shipping_status ?? 'pending') }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($order->created_at, 'Asia/Jakarta')
                        ->setTimezone('Asia/Jakarta')
                        ->format('d-m-Y H:i:s') }}
                </td>
                <td>
                    <div class="btn-group">
                        <!-- Edit Status -->
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="{{ '#statusModal' . $order->id }}">
                            <i class="fa fa-edit"></i>
                        </button>

                        <!-- Detail Order -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="{{ '#detailModal' . $order->id }}">
                            <i class="fa fa-eye"></i>
                        </button>

                        <!-- Hapus (tampilkan hanya jika perlu) -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="{{ '#deleteModal' . $order->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>

                    <!-- Modal Detail Order-->
                    <div class="modal fade" id="{{ 'detailModal' . $order->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $order->id }}">Detail Order #{{ $order->id }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label mb-1">Nama</label>
                                        <input type="text" class="form-control shadow-none" value="{{ $order->nama }}" readonly>
                                    </div>

                                    <div class="col-md-6 p-0 mb-3">
                                        <label class="form-label mb-1">Kontak</label>
                                        <input type="text" class="form-control shadow-none" value="{{ $order->kontak }}" readonly>
                                    </div>

                                    <div class="col-md-12 ps-0 mb-3">
                                        <label class="form-label mb-1">Alamat</label>
                                        <input type="text" class="form-control shadow-none" value="{{ $order->alamat }}" readonly>
                                    </div>

                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label mb-1">Email</label>
                                        <input type="text" class="form-control shadow-none" value="{{ $order->email ?? '-' }}" readonly>
                                    </div>

                                    <div class="col-md-6 p-0 mb-3">
                                        <label class="form-label mb-1">Metode Pembayaran</label>
                                        <input type="text" class="form-control shadow-none" value="{{ strtoupper($order->payment_method ?? '-') }}" readonly>
                                    </div>

                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label mb-1">Status Bayar</label>
                                        <input type="text" class="form-control shadow-none" value="{{ ucfirst($order->status) }}" readonly>
                                    </div>

                                    <div class="col-md-6 p-0 mb-3">
                                        <label class="form-label mb-1">Status Kirim</label>
                                        <input type="text" class="form-control shadow-none" value="{{ ucfirst($order->shipping_status ?? 'pending') }}" readonly>
                                    </div>

                                    <div class="col-md-6 ps-0 mb-3">
                                        <label class="form-label mb-1">Total Harga</label>
                                        <input type="text" class="form-control shadow-none" value="Rp{{ number_format($order->total_harga,0,',','.') }}" readonly>
                                    </div>

                                    <div class="col-md-12 ps-0 mb-3">
                                        <label class="form-label mb-1">Keterangan</label>
                                        <div class="border p-3 rounded bg-light" style="min-height: 80px;">
                                            {!! $order->keterangan ?? '<em>Tidak ada keterangan</em>' !!}
                                        </div>
                                    </div>

                                    <div class="col-md-12 ps-0 mb-3">
                                        <label class="form-label mb-1">Bukti Pembayaran</label>
                                        <div>
                                            @if($order->bukti_pembayaran)
                                                <img src="{{ asset('admin/upload/transaksi/' . $order->bukti_pembayaran) }}" 
                                                    class="img img-fluid img-thumbnail" 
                                                    alt="Bukti {{ $order->id }}" 
                                                    style="max-width: 250px;">
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

                    <!-- Modal Update Status-->
                    <div class="modal fade" id="{{ 'statusModal' . $order->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="statusModalLabel{{ $order->id }}">Update Status Order</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Status Bayar</label>
                                            <select name="status" class="form-control">
                                                @foreach(['pending','paid','failed','refunded'] as $status)
                                                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                                        {{ ucfirst($status) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Status Kirim</label>
                                            <select name="shipping_status" class="form-control">
                                                @foreach(['pending','shipped','delivered','cancelled'] as $ship)
                                                    <option value="{{ $ship }}" {{ ($order->shipping_status ?? '') == $ship ? 'selected' : '' }}>
                                                        {{ ucfirst($ship) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Delete Confirmation -->
                    <div class="modal fade" id="{{ 'deleteModal' . $order->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $order->id }}">Konfirmasi Hapus</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Data Yang di Hapus Tidak Dapat Dikembalikan!!!
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form action="{{ route('orders.delete', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus Data</button>
                                </form>
                              </div>
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
