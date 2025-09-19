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


  <div class="col-md-12">
    <div class="btn-group"> 
        <a href="{{ asset('administrator/category/tambah') }}" style="color: white;">
        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#Tambah">
            <i class="fa fa-plus"></i> Tambah Data Category
        </a>
    </div>
</div>
</div>
<div class="table-responsive mailbox-messages mt-1">        
<table class="table mt-3 table-sm table-bordered">
    <thead>
        <tr class="bg-info">
            <th class="text-center">NO</th>
            <th>GAMBAR</th>
            <th>NAMA</th>
            <th>UPDATE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($category as $category)
        <tr>
            <td class="text-center">{{ $no }}</td>
            <td class="text-center">
                @if($category->gambar)
                    <img src="{{ asset('admin/upload/category/'.$category->gambar) }}" class="img img-fluid img-thumbnail" alt="Gambar {{ $category->judul }}" style="max-width: 100px;">
                @else
                    <span class="badge badge-warning">Tidak ada</span>
                @endif
            </td>
            <td><?php echo $category->nama ?></td>
            <td>{{ $category->tanggal_update ?? '-' }}</td>
            <td>
                <div class="btn-group">
                <a href="{{ asset('administrator/category/edit/'.$category->id_category) }}" 
                class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>


                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target={{"#exampleModal" . $category->id_category}}>
                    <i class="fa fa-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id={{"exampleModal" . $category->id_category}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    Data Yang di Hapus Tidak Dapat Dikembalikan!!!
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('category.delete', $category->id_category) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus Data</button>
                        </form>
                    </div>
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
