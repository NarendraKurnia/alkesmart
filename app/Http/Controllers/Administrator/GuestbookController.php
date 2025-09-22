<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\GuestbookModel;
use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    // Index
    public function index(Request $request)
    {
        $query = GuestbookModel::orderBy('id_guestbook', 'DESC');
        $guestbook = $query->paginate(10); 
    
    
        $data = [ 
            'title'   => 'Data Guestbook',
            'guestbook' => $guestbook,
            'content'  => 'administrator/guestbook/index'
        ];

        return view('administrator/layout/wrapper', $data);
    }
    // delete
    public function delete($id)
    {
        $m_guestbook = new GuestbookModel();
        $data   = ['id_guestbook' => $id];
        $m_guestbook->hapus($data);   
          
        return redirect('administrator/guestbook')->with(['sukses' => 'Data Telah Dihapus']);
    }
}
