<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProdukModel extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'category_id',
        'nama',
        'status',
        'keterangan',
        'harga',
        'kondisi',
        'warna',
        'garansi',
        'gambar',
    ];

    // Relasi ke kategori
    public function category()
{
    return $this->belongsTo(Category_Model::class, 'category_id', 'id_category');
}


    //listing
    public function listing()
    {
        return DB::table('produk')
            ->select('*')
            ->orderBy('id_produk','DESC') // ✅ fix typo
            ->get();
    }

    // tambah 
    public function tambah ($data)
    {
        DB::table('produk')->insert($data);
    }
    // detail
    public function detail($id_produk)
    {
        $query = DB::table('produk')
            ->select('*')
            ->where('id_produk', $id_produk)
            ->orderBy('id_produk','DESC')
            ->first();
        return $query;
    }

    // edit 
    public function edit($id_produk, $data)
    {
    DB::table('produk')
        ->where('id_produk', $id_produk)
        ->update($data);
    }


    // hapus
    public function hapus ($data)
    {
        DB::table('produk')
            ->where('id_produk',$data['id_produk'])
            ->delete();
    }
}

