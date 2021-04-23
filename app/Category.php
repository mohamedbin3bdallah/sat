<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';

	protected $fillable = [
        'type','title', 'description','image','parent', 'order', 'status',
    ];

	public  $timestamps= true;

	public function parent()
	{
		return $this->hasOne('App\Category', 'id' ,'parent');
	}

	public function children()
	{
		return $this->hasMany('App\Category', 'parent', 'id')->orderBy('order');
	}

	public function product()
	{
		return $this->hasMany('App\Service', 'category_id', 'id');
	}

	public function solution()
	{
		return $this->hasMany('App\Service', 'category_id', 'id');
	}
	
	public function catdoc()
	{
		return $this->hasMany('App\Catdocs', 'category_id', 'id');
	}
}
