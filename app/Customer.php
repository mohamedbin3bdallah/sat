<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table = 'customers';

	protected $fillable = [
        'name', 'mobile','phone','email', 'company_id', 'status',
    ];

	public  $timestamps= true;

	public function company()
	{
		return $this->hasOne('App\Company', 'id' ,'company_id');
	}
}
