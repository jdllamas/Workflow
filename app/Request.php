<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'date_requested', 'date_closed'
    ];

	public function process()
    {
        return $this->hasMany('App\Process');
    }
	
	public function user()
    {
        return $this->hasMany('App\User');
    }
	
	public function requestData()
    {
        return $this->belongsTo('App\RequestData');
    }
	
	public function requestNote()
    {
        return $this->belongsTo('App\RequestNote');
    }
	
	public function requestFile()
    {
        return $this->belongsTo('App\RequestFile');
    }

	public function userstakeholders()
    {
        return $this->belongsToMany('App\User', 'requeststakeholder');
    }
	
}
