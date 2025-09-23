<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProdukModel;
use Barryvdh\DomPDF\Facade\Pdf;

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
    if ($request->hasFile('bukti_pembayaran')) {
    $file = $request->file('bukti_pembayaran');
    $filename = time() . '_' . $file->getClientOriginalName(); // beri nama unik
    $file->move(public_path('admin/upload/transaksi'), $filename);
    $buktiPath = 'admin/upload/transaksi/' . $filename; // simpan path lengkap ke DB
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
public function downloadPdf($orderId)
{
    // Ambil data order
    $order = DB::table('orders')->where('id', $orderId)->first();

    // Ambil detail produk
    $items = DB::table('order_items')
                ->join('produk', 'order_items.product_id', '=', 'produk.id_produk')
                ->where('order_items.order_id', $orderId)
                ->select('produk.nama', 'order_items.qty', 'order_items.harga_satuan', 'order_items.total_harga')
                ->get();

    // Generate PDF
    $pdf = Pdf::loadView('checkout.pdf', compact('order', 'items'));

    // Download
    return $pdf->download('transaksi_'.$order->id.'.pdf');
}

    // ... method lain ...

    public function cancel(Request $request, $orderId)
{
    $order = DB::table('orders')->where('id', $orderId)->first();
    if (!$order) {
        return redirect()->back()->with('error', 'Order tidak ditemukan.');
    }

    // baca tipe column dari INFORMATION_SCHEMA untuk shipping_status dan status
    $dbName = env('DB_DATABASE');

    $colShip = DB::selectOne(
        "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = ?",
        [$dbName, 'orders', 'shipping_status']
    );

    $colStatus = DB::selectOne(
        "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND COLUMN_NAME = ?",
        [$dbName, 'orders', 'status']
    );

    $shipType = $colShip->COLUMN_TYPE ?? '';
    $statusType = $colStatus->COLUMN_TYPE ?? '';

    // cek apakah enum punya 'canceled' atau 'cancelled'
    $shipHasCanceled = stripos($shipType, "'canceled'") !== false;
    $shipHasCancelled = stripos($shipType, "'cancelled'") !== false;

    $statusHasCanceled = stripos($statusType, "'canceled'") !== false;
    $statusHasCancelled = stripos($statusType, "'cancelled'") !== false;

    // pilih ejaan yang sesuai (prioritaskan yang ada di DB)
    $shipVal = $shipHasCanceled ? 'canceled' : ($shipHasCancelled ? 'cancelled' : 'canceled');
    $statusVal = $statusHasCanceled ? 'canceled' : ($statusHasCancelled ? 'cancelled' : 'canceled');

    // cek apakah order sudah tidak bisa dibatalkan
    $currentShip = strtolower($order->shipping_status ?? 'pending');
    $notCancelable = ['shipped', 'delivered', 'in_transit', 'on_delivery', 'delivering'];
    if (in_array($currentShip, $notCancelable)) {
        return redirect()->route('checkout.success', ['orderId' => $orderId])
                         ->with('error', 'Pesanan sudah dalam proses pengiriman dan tidak dapat dibatalkan.');
    }

    // lakukan update dengan nilai yang sesuai
    DB::table('orders')->where('id', $orderId)->update([
        'shipping_status' => $shipVal,
        'status' => $statusVal,
        'updated_at' => now(),
    ]);

    return redirect()->route('checkout.success', ['orderId' => $orderId])
                     ->with('success', 'Pesanan berhasil dibatalkan.');
}

}
