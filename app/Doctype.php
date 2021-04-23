<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctype extends Model
{
	protected $table = 'document_types';

	protected $fillable = [
        'type_name', 'status',
    ];

	public  $timestamps= true;

	/*public function user()
	{
		return $this->hasOne('App\User', 'id' ,'user_id');
	}*/
}
