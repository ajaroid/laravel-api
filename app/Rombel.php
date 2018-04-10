<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    public $timestamps = false;
    protected $fillable = ['tahun_ajar', 'siswa_id', 'kelas_id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
