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
    //index
    public function index(Request $request)
    {
        $banner = Banner_Model::all();
        $category = Category_Model::all();
        $produk = ProdukModel::all();

        return view('index', [ 
            'title' => 'Alkesmart',
            'categories' => $category,
            'banner'  => $banner,
            'products' => $produk
        ]);
    }
    public function detailProduk($id)
    {
        $category = Category_Model::all();
        $produk = ProdukModel::all();


        $produk = ProdukModel::with('category')
                   ->where('id_produk', $id)
                   ->firstOrFail();

        $produk_terkini = ProdukModel::with('category')
            ->where('id_produk', '!=', $id)
            ->orderBy('id_produk', 'DESC')
            ->take(4)
            ->get();

        $key = 'produk_viewed_' . $produk->id_produk;
        if (!session()->has($key)) {

            session()->put($key, true);
        }

        return view('produk.detail', [
            'product'  => $produk,
            'category'  => $category,
            'title'     => $produk->nama,
            'latestProducts' => $produk_terkini
        ]);
    }
    public function byCategory($slug)
{
    $categories = Category_Model::all(); // semua kategori
    $category = Category_Model::where('slug', $slug)->firstOrFail(); // kategori yang dipilih
    $products = ProdukModel::where('category_id', $category->id)->get();

    return view('produk.category', compact('categories', 'category', 'products'));
}
}
