<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeRekening extends Model
{
    //
	protected $table = 'kode_rekening';
	public $primaryKey = "id_rekening";
	public $incrementing = false;
	protected $fillable = [
        'id_rekening',
        'nama_rekening',
        'balance',
        'biaya'
    ];
}
