<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderModel extends Model
{
    protected $table = 'orders'; // nama tabel
    protected $primaryKey = 'id'; // tambahkan! kalau PK kamu bukan "id"
    public $timestamps = false; // tambahkan kalau tabel tidak ada created_at & updated_at

    protected $fillable = ['nama', 'kontak'];

    // listing
    public function listing()
    {
        return DB::table($this->table)
            ->select('*')
            ->orderBy('id','DESC')
            ->get();
    }

    // tambah
    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    // detail
    public function detail($id)
    {
        return DB::table($this->table)
            ->select('*')
            ->where('id', $id)
            ->orderBy('id','DESC')
            ->first();
    }
    // hapus
    public function hapus($data)
    {
        DB::table($this->table)
            ->where('id',$data['id'])
            ->delete();
    }
}
