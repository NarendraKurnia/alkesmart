<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User_Model extends Model
{
    protected $table = 'pengguna'; // nama tabel
    protected $primaryKey = 'id_user'; // tambahkan! kalau PK kamu bukan "id"
    public $timestamps = false; // tambahkan kalau tabel tidak ada created_at & updated_at

    protected $fillable = ['nama', 'email', 'username', 'password', 'pegawai_id'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai_Model::class, 'pegawai_id', 'id_pegawai');
    }

    // listing
    public function listing()
    {
        return DB::table($this->table)
            ->select('*')
            ->orderBy('id_user','DESC')
            ->get();
    }

    // tambah
    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    // detail
    public function detail($id_user)
    {
        return DB::table($this->table)
            ->select('*')
            ->where('id_user', $id_user)
            ->orderBy('id_user','DESC')
            ->first();
    }

    // login
    public function login($username, $password)
    {
        return DB::table($this->table)
            ->select('id_user', 'username', 'nama', 'pegawai_id', 'password')
            ->where('username', $username)
            ->where('password', sha1($password))
            ->first();
    }

    // edit
    public function edit($data)
    {
        DB::table($this->table)
            ->where('id_user',$data['id_user'])
            ->update($data);
    }

    // hapus
    public function hapus($data)
    {
        DB::table($this->table)
            ->where('id_user',$data['id_user'])
            ->delete();
    }
}
