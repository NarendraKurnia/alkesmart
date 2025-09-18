<?php 

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Pegawai_Model;
use App\Models\User_Model;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Index
    public function index(Request $request)
    {
        $query = User_Model::with('pegawai')->orderBy('id_user', 'DESC');
        $pengguna = $query->paginate(10); 
    
        $pegawai_id = session()->get('pegawai_id');
        $pegawai = Pegawai_Model::where('id_pegawai', $pegawai_id)->first();
    
        $data = [ 
            'title'   => 'Data User Administrator',
            'pengguna' => $pengguna,
            'pegawai'  => $pegawai,
            'content'  => 'administrator/user/index'
        ];

        return view('administrator/layout/wrapper', $data);
    }

    // tambah
    public function tambah()
    {
        $pegawai = Pegawai_Model::select('id_pegawai', 'nama')->get();

        $data = [ 
            'title'   => 'Tambah Data User Administrator',
            'pegawai' => $pegawai, 
            'content' => 'administrator/user/tambah'
        ];

        return view('administrator/layout/wrapper', $data);
    }

    // proses_tambah
    public function proses_tambah(Request $request)
    {
        $m_pengguna = new User_Model();

        $request->validate([
            'username'   => 'required|unique:pengguna,username',
            'email'      => 'required|unique:pengguna,email',
            'nama'       => 'required',
            'password'   => 'required|min:6',
            'pegawai_id' => 'required|exists:pegawai,id_pegawai'
        ]);

        $data = [
            'nama'       => $request->nama,
            'email'      => $request->email,
            'username'   => $request->username,
            'password'   => sha1($request->password),
            'pegawai_id' => $request->pegawai_id,
        ];

        $m_pengguna->tambah($data);

        return redirect('administrator/user')->with(['sukses' => 'Data Telah Ditambah']);
    }

    // edit
    public function edit($id_user)
    {
        $pegawai = Pegawai_Model::select('id_pegawai', 'nama')->get();
        $m_pengguna  = new User_Model();
        $pengguna    = $m_pengguna->detail($id_user);
        
        $data = [ 
            'title'   => 'Edit User Administrator',
            'pengguna'    => $pengguna,
            'pegawai' => $pegawai,
            'content' => 'administrator/user/edit'
        ];
        return view('administrator/layout/wrapper',$data);
    }

    // proses_edit
    public function proses_edit(Request $request)
    {
        $m_user = new User_Model();

        $request->validate([
            'username' => 'required',
            'email'    => 'required',
            'nama'     => 'required',
        ]);

        $password = $request->password;

        if (!empty($password) && strlen($password) >= 6 && strlen($password) <= 32) {
            $data = [
                'id_user'    => $request->id_user,
                'nama'       => $request->nama,
                'email'      => $request->email,
                'username'   => $request->username,
                'password'   => sha1($password),
                'pegawai_id' => $request->pegawai_id,
            ];
        } else {   
            $data = [
                'id_user'    => $request->id_user,
                'nama'       => $request->nama,
                'email'      => $request->email,
                'username'   => $request->username,
                'pegawai_id' => $request->pegawai_id,
            ];
        }

        $m_user->edit($data);

        return redirect('administrator/user')->with(['sukses' => 'Data Telah Diedit']);
    }

    // delete
    public function delete($id)
    {
        $m_user = new User_Model();
        $data   = ['id_user' => $id];
        $m_user->hapus($data);   
          
        return redirect('administrator/user')->with(['sukses' => 'Data Telah Dihapus']);
    }
}
