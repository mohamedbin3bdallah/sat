<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $table = 'companies';

	protected $fillable = [
        'name', 'code', 'status',
    ];

	public  $timestamps= true;

	/*public function user()
	{
		return $this->hasOne('App\User', 'id' ,'user_id');
	}*/
}
