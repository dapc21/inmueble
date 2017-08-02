<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFacility extends Model
{
	protected $table = 'properties_facilities';
	protected $fillable = ['property_id','facility_id'];
	protected $dates = ['deleted_at'];
    /****************************************************************/
    /*********************** RELACIONES *****************************/
    /****************************************************************/
    public function properties()
    {
        return $this->belongsTo('App\Property', 'property_id');
    }

    public function facilities()
    {
        return $this->belongsTo('App\Facility', 'facility_id');
    }
}
