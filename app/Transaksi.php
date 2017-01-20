<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
	protected $table = 'transaksi';
	public $incrementing = false;
	protected $fillable = [
        'id',
        'jenis_jurnal',
        'created_by'
    ];
	
	public function jenisJurnal(){
        return $this->belongsTo('App\JenisJurnal','jenis_jurnal');
    }
	
	public function createdBy(){
        return $this->belongsTo('App\User','created_by');
    }
}
