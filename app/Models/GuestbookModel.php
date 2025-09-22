<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GuestbookModel extends Model
{
    protected $table = 'guestbook'; // nama tabel
    protected $primaryKey = 'id_guestbook'; // tambahkan! kalau PK kamu bukan "id"
    public $timestamps = false; // tambahkan kalau tabel tidak ada created_at & updated_at

    protected $fillable = ['nama', 'keterangan'];

    // listing
    public function listing()
    {
        return DB::table($this->table)
            ->select('*')
            ->orderBy('id_guestbook','DESC')
            ->get();
    }

    // tambah
    public function tambah($data)
    {
        DB::table($this->table)->insert($data);
    }

    // detail
    public function detail($id_guestbook)
    {
        return DB::table($this->table)
            ->select('*')
            ->where('id_guestbook', $id_guestbook)
            ->orderBy('id_guestbook','DESC')
            ->first();
    }
    // hapus
    public function hapus($data)
    {
        DB::table($this->table)
            ->where('id_guestbook',$data['id_guestbook'])
            ->delete();
    }
}
