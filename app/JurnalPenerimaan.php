<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JurnalPenerimaan extends Model
{
    //
	protected $table = 'penerimaan';
	protected $primaryKey = false;
	public $incrementing = false;
	protected $fillable = [
        'kode_rekening',
        'semester',
        'nim_mhs',
        'nama_mhs',
        'prodi',
        'setoran',
        'tanggal',
        'id_transaksi'
    ];
	
	public function jenisPembayaran(){
        return $this->belongsTo('App\KodeRekening','kode_rekening');
    }
	
	public function transaksi(){
        return $this->belongsTo('App\Transaksi','id_transaksi');
    }
	
	public function dataProdi(){
        return $this->belongsTo('App\Prodi','prodi');
    }
}
