<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    public function index()
    {
        // Ambil entri guestbook terbaru
        $guestbookEntries = DB::table('guestbook')->orderBy('created_at', 'desc')->get();
        $title = "Lokasi Dan Kontak" ;

        return view('lokasi.index', compact('guestbookEntries', 'title'));
    }

    // Simpan entri guestbook dari halaman lokasi
    public function storeGuestbook(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        DB::table('guestbook')->insert([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'created_at' => now()
        ]);

        return redirect()->back()->with('success', 'Terima kasih telah menulis di Guestbook!');
    }
}
