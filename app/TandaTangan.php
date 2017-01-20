<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TandaTangan extends Model
{
    //
	protected $table = 'tanda_tangan';
	protected $primaryKey = 'id_ttd';
	public $timestamps = false;
	public $incrementing = false;
	protected $fillable = [
        'nama',
        'jabatan',
        'nip'
    ];
}
