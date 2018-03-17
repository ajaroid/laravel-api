<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = ['id','nis','nama','jenis_kelamin','tempat_lahir','tanggal_lahir','alamat'];

    public function rombel()
    {
      return $this->hasMany(Rombel::class);
    }
}
