<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table = 'products_services';

	protected $fillable = [
        'title', 'brief', 'description', 'flag', 'flag_view', 'category_id', 'status',
    ];

	public  $timestamps= true;

	public function category()
	{
		return $this->belongsTo('App\Category', 'category_id');
	}

	public function document()
	{
		return $this->hasMany('App\Document', 'product_service_id', 'id')->orderBy('document_type_id', 'asc');
	}

	public function image()
	{
		return $this->hasMany('App\Image', 'product_service_id', 'id');
	}
}
