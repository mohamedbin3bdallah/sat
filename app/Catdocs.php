<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catdocs extends Model
{
	protected $table = 'category_docs';

	protected $fillable = [
        'document_name', 'category_id', 'status',
    ];

	public  $timestamps= true;
	
	public function category()
	{
		return $this->belongsTo('App\Category', 'category_id');
	}
}
