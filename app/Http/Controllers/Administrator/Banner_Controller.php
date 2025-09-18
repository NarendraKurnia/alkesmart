<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Pegawai_Model;
use Illuminate\Http\Request;
use App\Models\Banner_model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Banner_Controller extends Controller
{
    // Index
    public function index(Request $request)
    {
        $pegawai_id = session()->get('pegawai_id');
        // Tidak perlu pakai with('unit') karena tidak ada relasi unit
        $query = Banner_model::orderBy('id_banner', 'DESC');
        $banner = $query->paginate(10); 

        // Ambil data unit
        $pegawai_id = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();

        $data = [ 
            'title'   => 'Data Banner',
            'banner'  => $banner,
            'pegawai' => $pegawai_id,
            'content' => 'administrator/banner/index'
        ];

        return view('administrator/layout/wrapper', $data);
    }

    // tambah
    public function tambah()
    {

        $data = [ 
            'title'   => 'Tambah Data Banner',
            'content' => 'administrator/banner/tambah'
        ];

        return view('administrator/layout/wrapper', $data);
    }

    // proses_tambah
    public function proses_tambah(Request $request)

    {
        $m_banner     = new Banner_model();
        request()->validate([
                                    'judul'   => 'required',
                                    'gambar'  => 'nullable|file|image|mimes:jpeg,png,jpg|max:8024',
                                ]);
        // proses data input
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'admin/upload/banner/';
            $image->move($destinationPath, $input['nama_file']);

        $data   = [     'judul'         => $request->judul,
                        'gambar'   	    => $input['nama_file']
                    ];
                  }              
        $m_banner->tambah($data);
        // end proses
        return redirect('administrator/banner')->with(['sukses' => 'Data Telah Ditambah']);
    }

    // edit
    public function edit($id_banner)
    {
    $m_banner = new Banner_model();
    $banner   = $m_banner->detail($id_banner);

    $data = [
        'title'   => 'Edit Banner',
        'banner'  => $banner,
        'content' => 'admin/banner/edit'
    ];

    return view('admin/layout/wrapper', $data);
    }

    // proses edit
    public function proses_edit(Request $request)
    {
    $m_banner = new Banner_model();

    // Ambil id_banner dari form input
    $id_banner = $request->input('id_banner');
    $image     = $request->file('gambar');

    // 1. Validasi
    $request->validate([
        'judul'    => 'required',
        'gambar'   => 'nullable|file|image|mimes:jpeg,png,jpg|max:8024',
    ]);

    // 2. Siapkan data dasar untuk update
    $data = [
        'id_banner' => $id_banner,
        'judul'     => $request->judul,
    ];

    // 3. Jika ada gambar baru diupload
    if ($image) {
        // a) Hapus file lama jika ada
        $old = $m_banner->detail($id_banner);
        if (!empty($old->gambar)) {
            $oldPath = public_path('admin/upload/banner/' . $old->gambar);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // b) Simpan file baru
        $origName  = $image->getClientOriginalName();
        $filename  = pathinfo($origName, PATHINFO_FILENAME);
        $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
        $destPath  = public_path('admin/upload/banner/');
        $image->move($destPath, $nama_file);

        $data['gambar'] = $nama_file;
    }

    // 4. Update data
    $m_banner->edit($data);

    return redirect('banner')->with(['sukses' => 'Data Telah Diedit']);
    }
    
    //  delete
   public function delete($id)
   {
        $m_banner = new Banner_model();
        $data = ['id_banner' => $id];
        $m_banner->hapus($data);   
         
        return redirect('banner')->with(['sukses' => 'Data Telah Dihapus']);
   }
}
