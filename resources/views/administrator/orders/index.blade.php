@include('layout.head')
@include('layout.header')

<div class="container mx-auto py-8 px-4 pt-16">

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col md:flex-row justify-between mb-4 items-center">
        <!-- Search -->
        <form action="{{ url('administrator/orders') }}" method="get" class="w-full md:w-1/2 mb-2 md:mb-0">
            <div class="flex">
                <input type="text" name="keywords" placeholder="Cari nama pelanggan..." 
                       value="{{ request('keywords') }}" 
                       class="flex-1 border rounded-l px-3 py-2 focus:outline-none focus:ring">
                <button type="submit" class="bg-blue-500 text-white px-4 rounded-r hover:bg-blue-600">
                    <i class="fa fa-search"></i> Cari
                </button>
            </div>
        </form>

        <!-- Pagination -->
        <div class="w-full md:w-auto">
            {{ $orders->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border rounded-lg shadow-sm">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="text-center p-2 w-5%">NO</th>
                    <th class="p-2 w-15%">Nama</th>
                    <th class="p-2 w-15%">Kontak</th>
                    <th class="p-2 w-20%">Alamat</th>
                    <th class="p-2 w-10%">Status Bayar</th>
                    <th class="p-2 w-10%">Status Kirim</th>
                    <th class="p-2 w-15%">Tanggal</th>
                    <th class="p-2 w-10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $no = ($orders->currentPage() - 1) * $orders->perPage() + 1; @endphp
                @foreach($orders as $order)
                <tr class="border-t hover:bg-gray-50">
                    <td class="text-center p-2">{{ $no }}</td>
                    <td class="p-2">{{ $order->nama }}</td>
                    <td class="p-2">{{ $order->kontak }}</td>
                    <td class="p-2">{{ Str::limit($order->alamat, 50, '...') }}</td>
                    <td class="p-2">{{ ucfirst($order->status) }}</td>
                    <td class="p-2">{{ ucfirst($order->shipping_status ?? 'pending') }}</td>
                    <td class="p-2">{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i') }}</td>
                    <td class="p-2">
                        <div class="flex space-x-1">
                            <!-- Detail -->
                            <button type="button" class="bg-blue-500 text-white px-2 py-1 rounded" 
                                    data-toggle="modal" data-target="#detailModal{{ $order->id }}">
                                <i class="fa fa-eye"></i>
                            </button>

                            <!-- Edit Status -->
                            <button type="button" class="bg-yellow-400 text-white px-2 py-1 rounded" 
                                    data-toggle="modal" data-target="#statusModal{{ $order->id }}">
                                <i class="fa fa-edit"></i>
                            </button>

                            <!-- Hapus -->
                            <form action="{{ route('orders.delete', $order->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                <!-- Modal Detail -->
                <div class="modal fade" id="detailModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Order #{{ $order->id }}</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body space-y-2">
                                <p><strong>Nama:</strong> {{ $order->nama }}</p>
                                <p><strong>Kontak:</strong> {{ $order->kontak }}</p>
                                <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
                                <p><strong>Email:</strong> {{ $order->email ?? '-' }}</p>
                                <p><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method ?? '-') }}</p>
                                <p><strong>Status Bayar:</strong> {{ ucfirst($order->status) }}</p>
                                <p><strong>Status Kirim:</strong> {{ ucfirst($order->shipping_status ?? 'pending') }}</p>
                                <p><strong>Total Harga:</strong> Rp{{ number_format($order->total_harga,0,',','.') }}</p>
                                @if($order->bukti_pembayaran)
                                    <p><strong>Bukti Pembayaran:</strong></p>
                                    <img src="{{ asset('admin/upload/transaksi/' . $order->bukti_pembayaran) }}" 
                                         class="img-fluid rounded shadow" style="max-width:250px;">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Update Status -->
                <div class="modal fade" id="statusModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Status Order</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body space-y-4">
                                    <div>
                                        <label class="font-medium">Status Bayar</label>
                                        <select name="status" class="form-control">
                                            @foreach(['pending','paid','failed','refunded'] as $status)
                                                <option value="{{ $status }}" {{ $order->status==$status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="font-medium">Status Kirim</label>
                                        <select name="shipping_status" class="form-control">
                                            @foreach(['pending','shipped','delivered','cancelled'] as $ship)
                                                <option value="{{ $ship }}" {{ $order->shipping_status==$ship ? 'selected' : '' }}>
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

                @php $no++; @endphp
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('layout.footer')
