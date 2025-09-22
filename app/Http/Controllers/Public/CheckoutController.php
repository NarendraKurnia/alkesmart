<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProdukModel;

class CheckoutController extends Controller
{
    public function index()
    {
        // Ambil keranjang dari session
        $cart = session('cart', []);

        // Ambil produk dari database
        $products = ProdukModel::whereIn('id_produk', array_keys($cart))->get();
        $title = "Checkout ";

        return view('checkout.index', compact('products', 'cart', 'title'));
    }

    public function store(Request $request)
{
    $cart = session('cart', []);
    $products = ProdukModel::whereIn('id_produk', array_keys($cart))->get();

    // Hitung total harga
    $totalHarga = 0;
    foreach ($products as $prod) {
        $qty = $cart[$prod->id_produk]['quantity'] ?? 0;
        $totalHarga += $prod->harga * $qty;
    }

    // Upload bukti pembayaran jika ada
    $buktiPath = null;
    if ($request->hasFile('bukti_pembayaran')) {
        $file = $request->file('bukti_pembayaran');
        $buktiPath = $file->store('bukti_pembayaran', 'public');
    }

    // Simpan data order
    $orderId = DB::table('orders')->insertGetId([
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'kontak' => $request->kontak,
        'email' => $request->email,
        'id_paypal' => $request->id_paypal,
        'nama_bank' => $request->nama_bank,
        'payment_method' => $request->payment_method,
        'bukti_pembayaran' => $buktiPath,
        'total_harga' => $totalHarga,
        'status' => 'pending',
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // Simpan detail produk
    foreach ($products as $prod) {
        $qty = $cart[$prod->id_produk]['quantity'] ?? 0;
        if ($qty > 0) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $prod->id_produk,
                'qty' => $qty,
                'harga_satuan' => $prod->harga,
                'total_harga' => $prod->harga * $qty,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    // Kosongkan cart
    session()->forget('cart');

    // Redirect ke halaman success dengan orderId
    return redirect()->route('checkout.success', ['orderId' => $orderId]);
}
public function success($orderId)
{
    $order = DB::table('orders')->where('id', $orderId)->first();

    $items = DB::table('order_items')
        ->join('produk', 'order_items.product_id', '=', 'produk.id_produk')
        ->where('order_items.order_id', $orderId)
        ->select('produk.nama', 'order_items.qty', 'order_items.harga_satuan', 'order_items.total_harga')
        ->get();
    $title = "Transaksi Berhasil ";

    return view('checkout.success', compact('order', 'items', 'title'));
}

}
