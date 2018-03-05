<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $fillable = ['tahun_ajar','semester','siswa_id','kelas_id'];
}
