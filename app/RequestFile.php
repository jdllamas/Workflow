<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestFile extends Model
{
    /**
     * The attributes that are mass assignable.
     * type = 1 -> Initial | 2 -> Final (Scanned Join PDF)
     * @var array
     */
    protected $fillable = [
        'description', 'filename', 'date_uploaded', 'value', 'type'
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
