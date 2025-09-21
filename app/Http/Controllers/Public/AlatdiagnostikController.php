<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category_Model;
use App\Models\ProdukModel;
use Illuminate\Http\Request;

class AlatdiagnostikController extends Controller
{
    //Index
    public function index(Request $request)
    {
        $category = Category_Model::all();
        $produk = ProdukModel::all();

        return view('index', [ 
            'title' => 'Alkesmart',
            'category' => $category,
            'products' => $produk
        ]);
    }
}
