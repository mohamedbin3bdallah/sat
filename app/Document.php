<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
	protected $table = 'documents';

	protected $fillable = [
        'document_name', 'product_service_id','document_type_id', 'status',
    ];

	public  $timestamps= true;

	public function doctype()
	{
		return $this->belongsTo('App\Doctype', 'document_type_id');
	}
	
	public function service()
	{
		return $this->belongsTo('App\Service', 'product_service_id');
	}
}
