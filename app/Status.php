<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes;
	protected $table = 'statuses';
	protected $fillable = ['name'];
	protected $dates = ['deleted_at'];
    /****************************************************************/
    /*********************** RELACIONES *****************************/
    /****************************************************************/
    public function properties()
    {
        return $this->hasMany('App\Property');
    }
}
