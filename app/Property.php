<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
	protected $table = 'properties';
	protected $fillable = ['title','description','address','town','country','status_id'];
	protected $dates = ['deleted_at'];
    /****************************************************************/
    /*********************** RELACIONES *****************************/
    /****************************************************************/
    public function statuses()
    {
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function propertiesFacilities()
    {
        return $this->hasMany('App\PropertyFacility');
    }
	/****************************************************************/
	/************************* SCOPES *******************************/
	/****************************************************************/
    public function scopeByTitle($query, $title)
    {
      if($title != '') {
        return $query->where('title', 'LIKE' , '%'.trim($title).'%');
      }
    }
    public function scopeByAddress($query, $address)
    {
      if($address != '') {
        return $query->where('address', 'LIKE' , '%'.trim($address).'%');
      }
    }
    public function scopeByTown($query, $town)
    {
      if($town != '') {
        return $query->where('town', 'LIKE' , '%'.trim($town).'%');
      }
    }
    public function scopeByCountry($query, $country)
    {
      if($country != '') {
        return $query->where('country', 'LIKE' , '%'.trim($country).'%');
      }
    }

	public function scopeByStatus($query, $status)
    {
		return $query->whereHas('statuses', function($q) use ($status) 
		{
			if($status != '') {
				$q->where('name', 'LIKE' , '%'.trim($status).'%');
			}
		})->paginate(10);
    }

    public function scopeOrderByCreatedAtAsc($query)
    {
        return $query->orderBy('created_at', 'asc');
    }

    public function scopeOrderByCreatedAtDesc($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeOrderByUpdatedAtAsc($query)
    {
        return $query->orderBy('updated_at', 'asc');
    }

    public function scopeOrderByUpdatedAtDesc($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }
}
