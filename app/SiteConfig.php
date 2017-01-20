<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    //
	protected $table = 'site_configuration';
	public $timestamps = false;
	public $incrementing = false;
	protected $fillable = [
        'name_app',
        'logo',
        'image_welcome'
    ];
}
