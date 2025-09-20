<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\ProdukModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function add(Request $request, $id)
    {
        $produk = ProdukModel::findOrFail($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nama" => $produk->nama,
                "harga" => $produk->harga,
                "gambar" => $produk->gambar,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => $produk->nama.' berhasil ditambahkan ke keranjang!',
            'cart' => $cart
        ]);
    }
    public function update(Request $request, $id)
{
    $cart = session()->get('cart', []);
    if(isset($cart[$id])) {
        $cart[$id]['quantity'] += $request->delta;
        if($cart[$id]['quantity'] <= 0) unset($cart[$id]);
    }
    session()->put('cart', $cart);

    return response()->json(['cart' => $cart]);
}

public function remove(Request $request, $id)
{
    $cart = session()->get('cart', []);
    if(isset($cart[$id])) unset($cart[$id]);
    session()->put('cart', $cart);

    return response()->json(['cart' => $cart]);
}

}
