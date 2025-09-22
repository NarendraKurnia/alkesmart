<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
     public function index()
    {
        $data = [
            'title'   => 'Login Administrator',
            'content' => 'login/index'
        ];
        return view('login/layout', $data);
    }

    /**
     * Proses cek login
     */
    public function cek_login(Request $request)
    {
        $m_pengguna = new UserModel();
        $username   = $request->username;
        $password   = $request->password;

        // Panggil method login di model
        $pengguna = $m_pengguna->login($username, $password);

        if ($pengguna) {
            // Simpan session
            $request->session()->put('id_user',   $pengguna->id_user);
            $request->session()->put('username',  $pengguna->username);
            $request->session()->put('nama',      $pengguna->nama);

            return redirect('/')->with(['sukses' => 'Anda Berhasil Login']);
        } else {
            return redirect('login')->with(['warning' => 'Username atau Password salah']);
        }
    }
    public function register()
    {
        $data = [
            'title'   => 'Register',
            'content' => 'login/register'
        ];
        return view('login.layout', $data); // halaman register
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

        return redirect('register')->with(['sukses' => 'Data Telah Ditambah']);
    }

    /**
     * Tampilkan form lupa password
     */
    public function lupa_password()
    {
        $data = [
            'title'   => 'Reset Password',
            'content' => 'admin/login/lupa_password'
        ];
        return view('admin/login/layout', $data);
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Session::forget(['id_user', 'username', 'nama']);
        return redirect('login')->with(['sukses' => 'Anda Berhasil logout']);
    }

    /**
     * Tampilkan form ganti password (profil)
     */
    public function edit()
{
    $id_user = session('id_user');
    $m_user  = new UserModel();
    $user    = $m_user->detail($id_user);

    // kirim content ke login layout
    return view('admin/login/layout', [
      'title'   => 'Ganti Password',
      'user'    => $user,
    ]);
}



    /**
     * Proses ganti password
     */
    public function proses_edit(Request $request)
    {
        $request->validate([
            'old_password'              => 'required',
            'new_password'              => 'required|min:6|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        $id_user = session('id_user');
        $m_user  = new UserModel();
        $user    = $m_user->detail($id_user);

        // Cek password lama (karena di model pakai sha1)
        if (sha1($request->old_password) !== $user->password) {
            return redirect()->route('akun.edit')
                             ->with(['warning' => 'Password lama tidak cocok.']);
        }

        // Update password
        $m_user->edit([
            'id_user'  => $id_user,
            'password' => sha1($request->new_password),
        ]);

        return redirect()->route('akun.edit')
                         ->with(['sukses' => 'Password berhasil diubah.']);
    }
}
