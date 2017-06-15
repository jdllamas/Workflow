<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
	use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username',
    ];
	protected $primaryKey = 'username';
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function process()
    {
        return $this->belongsToMany('App\Process', 'ProcessAdmin');
    }
	
	public function request()
    {
        return $this->belongsTo('App\Request');
    }
	
	public function requestFile()
    {
        return $this->belongsTo('App\RequestFile');
    }
	
	public function requeststakeholders()
    {
        return $this->belongsToMany('App\Request', 'requeststakeholder');
    }
	
}
