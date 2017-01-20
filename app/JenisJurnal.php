<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisJurnal extends Model
{
    //
	protected $table = 'jenis_jurnal';
	protected $fillable = [
        'nama_jurnal'
    ];
}
