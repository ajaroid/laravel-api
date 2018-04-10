<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'nama'];

    public function rombel()
    {
        return $this->hasMany(Rombel::class);
    }
}
