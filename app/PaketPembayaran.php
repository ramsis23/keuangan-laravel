<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketPembayaran extends Model
{
    //
	protected $table = 'paket_pembayaran';
	protected $fillable = [
        'nama'
    ];
}
