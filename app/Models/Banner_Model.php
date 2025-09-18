<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banner_Model extends Model
{
    use HasFactory;

    // Tambahkan ini
    protected $table = 'banner';

    // Jika tidak pakai timestamps (created_at, updated_at), tambahkan:
    public $timestamps = false;

    // Fungsi listing manual (opsional jika tetap dipakai)
    public function listing()
    {
        return DB::table('banner')
            ->select('*')
            ->orderBy('id_banner', 'DESC')
            ->get();
    }

    // tambah 
    public function tambah ($data)
    {
        DB::table('banner')->insert($data);
    }
    // detail
    public function detail($id_banner)
    {
        $query = DB::table('banner')
            ->select('*')
            ->where('id_banner', $id_banner)
            ->orderBy('id_banner','DESC')
            ->first();
        return $query;
    }

    // edit 
    public function edit ($data)
    {
        DB::table('banner')
            ->where('id_banner',$data['id_banner'])
            ->update($data);
    }
    // hapus
    public function hapus ($data)
    {
        DB::table('banner')
            ->where('id_banner',$data['id_banner'])
            ->delete();
    }
}
