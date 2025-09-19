<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Category_Model;
use App\Models\Pegawai_Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //// Index
    public function index(Request $request)
    {
        $pegawai_id = session()->get('pegawai_id');
        // Tidak perlu pakai with('unit') karena tidak ada relasi unit
        $query = Category_Model::orderBy('id_category', 'DESC');
        $category = $query->paginate(10); 

        // Ambil data unit
        $pegawai_id = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();

        $data = [ 
            'title'   => 'Data category',
            'category'  => $category,
            'pegawai' => $pegawai_id,
            'content' => 'administrator/category/index'
        ];

        return view('administrator/layout/wrapper', $data);
    }

    // tambah
    public function tambah()
    {

        $data = [ 
            'title'   => 'Tambah Data category',
            'content' => 'administrator/category/tambah'
        ];

        return view('administrator/layout/wrapper', $data);
    }

    // proses_tambah
    public function proses_tambah(Request $request)

    {
        $m_banner     = new Category_Model();
        request()->validate([
                                    'nama'   => 'required',
                                    'gambar'  => 'nullable|file|image|mimes:jpeg,png,jpg|max:8024',
                                ]);
        // proses data input
        $image                  = $request->file('gambar');
        if(!empty($image)) {
            $filenamewithextension  = $request->file('gambar')->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $input['nama_file']     = Str::slug($filename, '-').'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'admin/upload/category/';
            $image->move($destinationPath, $input['nama_file']);

        $data   = [     'nama'          => $request->nama,
                        'gambar'   	    => $input['nama_file']
                    ];
                  }              
        $m_banner->tambah($data);
        // end proses
        return redirect('administrator/category')->with(['sukses' => 'Data Telah Ditambah']);
    }

    // edit
    public function edit($id_category)
    {
    $m_category = new Category_Model();
    $category   = $m_category->detail($id_category);

    $data = [
        'title'   => 'Edit category',
        'category'  => $category,
        'content' => 'administrator/category/edit'
    ];

    return view('administrator/layout/wrapper', $data);
    }

    // proses edit
    public function proses_edit(Request $request)
    {
    $m_category = new Category_Model();

    // Ambil id_banner dari form input
    $id_category = $request->input('id_category');
    $image     = $request->file('gambar');

    // 1. Validasi
    $request->validate([
        'nama'     => 'required',
        'gambar'   => 'nullable|file|image|mimes:jpeg,png,jpg|max:8024',
    ]);

    // 2. Siapkan data dasar untuk update
    $data = [
        'id_category' => $id_category,
        'nama'        => $request->nama,
    ];

    // 3. Jika ada gambar baru diupload
    if ($image) {
        // a) Hapus file lama jika ada
        $old = $m_category->detail($id_category);
        if (!empty($old->gambar)) {
            $oldPath = public_path('admin/upload/category/' . $old->gambar);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // b) Simpan file baru
        $origName  = $image->getClientOriginalName();
        $filename  = pathinfo($origName, PATHINFO_FILENAME);
        $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
        $destPath  = public_path('admin/upload/category/');
        $image->move($destPath, $nama_file);

        $data['gambar'] = $nama_file;
    }

    // 4. Update data
    $m_category->edit($data);

    return redirect('administrator/category')->with(['sukses' => 'Data Telah Diedit']);
    }
    
    //  delete
   public function delete($id)
   {
        $m_category = new Category_Model();
        $data = ['id_category' => $id];
        $m_category->hapus($data);   
         
        return redirect('administrator/category')->with(['sukses' => 'Data Telah Dihapus']);
   }
}
