<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    //
	protected $table = 'prodi';
	public $primaryKey = "id_prodi";
	public $timestamps = false;
	protected $fillable = [
        'nama_prodi'
    ];
}
