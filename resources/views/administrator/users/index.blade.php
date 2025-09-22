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
        <a href="{{ asset('administrator/users/tambah') }}" style="color: white;">
        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#Tambah">
            <i class="fa fa-plus"></i> Tambah User
        </a>
    </div>
</div>
</div>
<div class="table-responsive mailbox-messages mt-1">        
<table class="table mt-3 table-sm table-bordered">
    <thead>
        <tr class="bg-info">
            <th class="text-center">NO</th>
            <th>NAMA</th>
            <th>EMAIL</th>
            <th>USERNAME</th>
            <th>KONTAK</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($users as $users)
        <tr>
            <td class="text-center">{{ $no }}</td>
            <td><?php echo $users->nama ?></td>
            <td><?php echo $users->email ?></td>
            <td><?php echo $users->username ?></td>
            <td><?php echo $users->kontak ?></td>
            <td>
                <div class="btn-group">

                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target={{"#exampleModal" . $users->id_user}}>
                    <i class="fa fa-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id={{"exampleModal" . $users->id_user}} tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <form action="{{ route('users.delete', $users->id_user) }}" method="POST">
        @csrf
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
