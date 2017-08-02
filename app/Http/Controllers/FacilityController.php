<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use App\Facility;

class FacilityController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }
    /**
    * Display all Facilities.
    *
    * @return \Illuminate\Http\Response
    */
	public function allFacilities()
	{
		$facilities = Facility::select('name', 'id')->orderBy('name', 'asc')->get();
		foreach ($facilities as $facility) {
			$data[] = array(
				'id'   => $facility->id,
				'name' => $facility->name
			);
		}
		return $data;
	}
}
