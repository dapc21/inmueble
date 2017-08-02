<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use App\Status;

class StatusController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');
    }
    /**
    * Display all Statuses.
    *
    * @return \Illuminate\Http\Response
    */
	public function allStatuses()
	{
		$statuses = Status::select('name', 'id')->orderBy('name', 'asc')->get();
		$data[] = array("id" => "", "name" => "SELECCIONE EL ESTADO DEL INMUEBLE");
		foreach ($statuses as $status) {
			$data[] = array(
				'id'   => $status->id,
				'name' => $status->name
			);
		}
		return $data;
	}
}
