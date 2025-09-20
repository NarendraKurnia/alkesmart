<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category_Model extends Model
{
    use HasFactory;

    // Tambahkan ini
    protected $table = 'category';
    protected $primaryKey = 'id_category';

    // Jika tidak pakai timestamps (created_at, updated_at), tambahkan:
    public $timestamps = false;

    // Fungsi listing manual (opsional jika tetap dipakai)
    public function listing()
    {
        return DB::table('category')
            ->select('*')
            ->orderBy('id_category', 'DESC')
            ->get();
    }

    // tambah 
    public function tambah ($data)
    {
        DB::table('category')->insert($data);
    }
    // detail
    public function detail($id_category)
    {
        $query = DB::table('category')
            ->select('*')
            ->where('id_category', $id_category)
            ->orderBy('id_categor','DESC')
            ->first();
        return $query;
    }

    // edit 
    public function edit ($data)
    {
        DB::table('category')
            ->where('id_category',$data['id_category'])
            ->update($data);
    }
    // hapus
    public function hapus ($data)
    {
        DB::table('category')
            ->where('id_category',$data['id_category'])
            ->delete();
    }
    public function produk()
    {
        return $this->hasMany(ProdukModel::class, 'category_id', 'id');
    }
}
