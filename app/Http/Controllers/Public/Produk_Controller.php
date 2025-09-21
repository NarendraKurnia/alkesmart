<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category_Model;
use App\Models\ProdukModel;
use Illuminate\Http\Request;

class Produk_Controller extends Controller
{
   public function byCategory($slug)
{
    $categories = Category_Model::all(); 
    $category = Category_Model::where('slug', $slug)->firstOrFail(); 
    $products = ProdukModel::where('category_id', $category->id_category)->get(); 

    $title = "Kategori: " . $category->nama;

    return view('produk.category', compact('categories', 'category', 'products', 'title'));
}
}
