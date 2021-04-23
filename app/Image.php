<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	protected $table = 'product_service_images';

	protected $fillable = [
        'media_name', 'type','product_service_id', 'status',
    ];

	public  $timestamps= true;

	public function service()
	{
		return $this->hasOne('App\Service', 'id' ,'product_service_id');
	}

	public function doctype()
	{
		return $this->hasOne('App\Doctype', 'id' ,'type');
	}
}
