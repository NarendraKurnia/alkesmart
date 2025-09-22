<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request) {
    $orders = DB::table('orders')
                ->when($request->keywords, fn($q) => $q->where('nama', 'like', "%{$request->keywords}%"))
                ->orderBy('created_at', 'desc')
                ->paginate(10);
     $title = "Transaksi ";
    return view('administrator.orders.index', compact('orders', 'title'));
}

public function updateShipping(Request $request, $id) {
    DB::table('orders')->where('id', $id)->update([
        'shipping_status' => $request->shipping_status,
        'updated_at' => now()
    ]);
    return back()->with('success', 'Status pengiriman berhasil diperbarui.');
}

public function destroy($id)
    {
        $order = OrderModel::findOrFail($id);
        $order->delete();

        return redirect()->back()->with('success', 'Order berhasil dihapus!');
    }
public function updateStatus(Request $request, $id)
    {
        $order = OrderModel::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,paid,failed,refunded',
            'shipping_status' => 'required|in:pending,shipped,delivered,cancelled',
        ]);

        $order->status = $request->status;
        $order->shipping_status = $request->shipping_status;
        $order->save();

        return redirect()->back()->with('success', 'Status order berhasil diperbarui!');
    }


}
