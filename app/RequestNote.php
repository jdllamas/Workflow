<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestNote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date', 'value'
    ];

	public function request()
    {
        return $this->hasMany('App\Request');
    }
	
	public function user()
    {
        return $this->hasMany('App\User');
    }
	
}
