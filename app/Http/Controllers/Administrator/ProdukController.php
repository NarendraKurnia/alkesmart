<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Category_Model;
use App\Models\Pegawai_Model;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    //Daftar Produk
    public function index(Request $request)
    {
        $query = ProdukModel::with('category')->orderBy('id_produk', 'DESC');
        $produk = $query->paginate(10);

        $pegawai_id = session()->get('pegawai_id');
        $pegawai = null;
        if ($pegawai_id) {
            $pegawai = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();
        }

        $data = [
            'title'   => 'Daftar Kamar',
            'produk'   => $produk,
            'pegawai' => $pegawai,
            'content' => 'administrator/produk/index'
        ];

        return view('administrator/layout/wrapper', $data);
    }
    // Form tambah kamar
    public function tambah()
    {
        $category = Category_Model::all();

        $data = [
            'title'       => 'Tambah Produk',
            'category'    => $category,
            'content'     => 'administrator/produk/tambah'
        ];

        return view('administrator/layout/wrapper', $data);
    }

    // proses_tambah
    public function proses_tambah(Request $request)
    {
        $m_produk = new ProdukModel();
        $request->validate([
        'category_id' => 'required|exists:category,id_category',
        'nama'        => 'required',
        'status'      => 'required|in:Tersedia,Kosong',
        'harga'       => 'required|numeric',
        'kondisi'     => 'required',
        'warna'       => 'required',
        'garansi'     => 'required',
        'gambar'      => 'nullable|file|image|mimes:jpeg,png,jpg|max:8024',
    ]);


        $data = [
            'category_id' => $request->category_id,
            'nama'        => $request->nama,
            'status'      => $request->status,
            'keterangan'  => $request->keterangan,
            'kondisi'     => $request->kondisi,
            'warna'       => $request->warna,
            'harga'       => $request->harga,
            'garansi'     => $request->garansi,
        ];

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filenamewithextension  = $image->getClientOriginalName();
            $filename               = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $nama_file              = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath        = 'admin/upload/produk/';
            $image->move($destinationPath, $nama_file);

            $data['gambar'] = $nama_file;
        }

        $m_produk->tambah($data);

        return redirect('administrator/produk')->with(['sukses' => 'Data Telah Ditambah']);
    }
    // edit
    public function edit($id_produk)
    {
         $category = Category_Model::all();
    $m_produk = new ProdukModel();
    $produk   = $m_produk->detail($id_produk);

    $data = [
        'title'   => 'Edit Produk',
        'produk'  => $produk,
        'category'    => $category,
        'content' => 'administrator/produk/edit'
    ];

    return view('administrator/layout/wrapper', $data);
    }

    // proses edit
    public function proses_edit(Request $request)
    {
        $m_produk = new ProdukModel();

        // Ambil id_produk dari form
        $id_produk = $request->input('id_produk');
        $produk = $m_produk->detail($id_produk); // Ambil data lama

        if (!$produk) {
            return redirect('administrator/produk')->with(['error' => 'Data tidak ditemukan']);
        }

        // Validasi input
        $request->validate([
            'category_id' => 'required|exists:category,id_category',
            'nama'        => 'required|string|max:255',
            'status'      => 'required|in:Tersedia,Kosong',
            'harga'       => 'required|numeric',
            'kondisi'     => 'required|string|max:255',
            'warna'       => 'required|string|max:255',
            'garansi'     => 'required|string|max:255',
            'gambar'      => 'nullable|file|image|mimes:jpeg,png,jpg|max:8024',
        ]);

        // Siapkan data untuk update
        $data = [
            'category_id' => $request->category_id,
            'nama'        => $request->nama,
            'status'      => $request->status,
            'harga'       => $request->harga,
            'kondisi'     => $request->kondisi,
            'warna'       => $request->warna,
            'garansi'     => $request->garansi,
            'keterangan'  => $request->keterangan,
        ];

        // Jika ada gambar baru
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');

            // Hapus gambar lama jika ada
            if (!empty($produk->gambar) && file_exists(public_path('admin/upload/produk/' . $produk->gambar))) {
                unlink(public_path('admin/upload/produk/' . $produk->gambar));
            }

            // Simpan gambar baru
            $filename  = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $nama_file = Str::slug($filename, '-') . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/upload/produk/'), $nama_file);

            $data['gambar'] = $nama_file;
        }

        // Update data produk
        $m_produk->edit($id_produk, $data); // Pastikan method edit menerima 2 parameter: id & data

        return redirect('administrator/produk')->with(['sukses' => 'Data Telah Diedit']);
    }
    //  delete
   public function delete($id)
   {
        $m_produk = new ProdukModel();
        $data = ['id_produk' => $id];
        $m_produk->hapus($data);   
         
        return redirect('administrator/produk')->with(['sukses' => 'Data Telah Dihapus']);
   }


}
