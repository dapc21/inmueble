<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use SoftDeletes;
	protected $table = 'facilities';
	protected $fillable = ['name'];
	protected $dates = ['deleted_at'];
    /****************************************************************/
    /*********************** RELACIONES *****************************/
    /****************************************************************/
    public function propertiesFacilities()
    {
        return $this->hasMany('App\PropertyFacility');
    }
}
