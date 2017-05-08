<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'value'
    ];

	public function request()
    {
        return $this->hasMany('App\Request');
    }
	
}
