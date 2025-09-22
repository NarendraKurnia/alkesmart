<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    // Index
    public function index(Request $request)
    {
        $query = UserModel::orderBy('id_user', 'DESC');
        $users = $query->paginate(10); 
    
    
        $data = [ 
            'title'   => 'Data User Public',
            'users' => $users,
            'content'  => 'administrator/users/index'
        ];

        return view('administrator/layout/wrapper', $data);
    }
    public function tambah()
    {
        $data = [
            'title'   => 'Data User Public',
            'content' => 'administrator/users/tambah'
        ];
        return view('administrator/layout/wrapper', $data); // halaman register
    }
    // proses_tambah
    public function proses_tambah(Request $request)
    {
        $m_user = new UserModel();

        $request->validate([
            'nama'       => 'required',
            'username'   => 'required|unique:users,username',
            'email'      => 'required|unique:users,email',
            'password'   => 'required|min:6',
            'konfirmasi_password'   => 'required|min:6',
            'lahir'      => 'required',
            'gender'     => 'required|in:Pria,Wanita',
            'alamat'     => 'required',
            'kota'       => 'required',
            'kontak'     => 'required',
            'id_paypal'  => 'required',
            'nama_bank'  => 'required'
        ]);

        $data = [
            'nama'       => $request->nama,
            'email'      => $request->email,
            'username'   => $request->username,
            'password'   => sha1($request->password),
            'konfirmasi_password'   => sha1($request->konfirmasi_password),
            'lahir'      => $request->lahir,
            'gender'     => $request->gender,
            'alamat'     => $request->alamat,
            'kota'       => $request->kota,
            'kontak'     => $request->kontak,
            'id_paypal'  => $request->id_paypal,
            'nama_bank'  => $request->nama_bank
        ];

        $m_user->tambah($data);

        return redirect('administrator/users')->with(['sukses' => 'Data Telah Ditambah']);
    }
    // delete
    public function delete($id)
    {
        $m_user = new UserModel();
        $data   = ['id_user' => $id];
        $m_user->hapus($data);   
          
        return redirect('administrator/users')->with(['sukses' => 'Data Telah Dihapus']);
    }
}
