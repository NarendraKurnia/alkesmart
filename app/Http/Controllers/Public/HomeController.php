<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Banner_Model;
use App\Models\Category_Model;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $banner = Banner_Model::all();
        $category = Category_Model::all();
        $produk = ProdukModel::all();

        return view('index', [ 
            'title' => 'Alkesmart',
            'category' => $category,
            'banner'  => $banner,
            'products' => $produk
        ]);
    }
}
