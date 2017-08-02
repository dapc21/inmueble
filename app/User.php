<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
	use SoftDeletes, CanResetPassword;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	protected $dates = ['deleted_at'];
	
	public function setPasswordAttribute($valor){
		if(!empty($valor)){
			$this->attributes['password'] = \Hash::make($valor);
		}
	}
}
