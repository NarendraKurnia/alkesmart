<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category_Model;
use App\Models\ProdukModel;
use Illuminate\Http\Request;

class AlatdiagnostikController extends Controller
{
    public function alatdiagnostik(Request $request)
    {
        // Ambil kategori "alatdiagnostik"
        $category = Category_Model::where('nama', 'Alat Diagnostik')->first();

        // Jika kategori tidak ada
        if (!$category) {
            abort(404, 'Kategori tidak ditemukan');
        }

        // Ambil produk berdasarkan category_id
        $produk = ProdukModel::where('category_id', $category->id_category)->get();

        return view('produk.alatdiagnostik', [ 
            'title' => 'Alkesmart - Alat Diagnostik',
            'category' => $category,
            'products' => $produk
        ]);
    }
}
