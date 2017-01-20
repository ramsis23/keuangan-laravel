<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPembayaran extends Model
{
    //
	protected $table = 'item_pembayaran';
	protected $fillable = [
        'paket','rekening'
    ];
	
	public function dataPaket(){
        return $this->belongsTo('App\PaketPembayaran','paket');
    }
	
	public function dataRekening(){
        return $this->belongsTo('App\KodeRekening','rekening');
    }
}
