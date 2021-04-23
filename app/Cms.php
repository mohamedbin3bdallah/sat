<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
	protected $table = 'cms';

	protected $fillable = [
        'page_flag', 'section','title','content','image','link', 'status',
    ];

	public  $timestamps= true;
}
