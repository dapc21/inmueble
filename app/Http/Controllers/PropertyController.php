<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Route;
use Validator;
use Exception;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Property;
use App\PropertyFacility;
use App\Facility;
use App\Status;

class PropertyController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	* Get all the Properties paginated.
	*
	* @return \Illuminate\Http\Response
	*/
	public function getProperties($search, $option)
	{
		$text = mb_strtoupper($search);
		$numberRecords = 10;
		if($option == 'title') {
			$this->properties = Property::byTitle($text)->orderByCreatedAtDesc()->paginate($numberRecords);
		} else if($option == 'address') {
			$this->properties = Property::byAddress($text)->orderByCreatedAtDesc()->paginate($numberRecords);
		} else if($option == 'town') {
			$this->properties = Property::byTown($text)->orderByCreatedAtDesc()->paginate($numberRecords);
		} else if($option == 'country') {
			$this->properties = Property::byCountry($text)->orderByCreatedAtDesc()->paginate($numberRecords);
		} else if($option == 'status') {
		//el paginado se incluye en scope ByStatus por ser relación
			$this->properties = Property::orderByCreatedAtDesc()->byStatus($text);
		} else { //Consulta normal sin condiciones ni scopes
			$this->properties = Property::orderByCreatedAtDesc()->paginate($numberRecords);
		}
		return $this->properties;
	}
	/**
	* Get all the Facilities paginated.
	*
	* @return \Illuminate\Http\Response
	*/
	public function getFacilities()
	{
		$this->facilities = Facility::paginate(10);
		return $this->facilities;
	}
	/**
	* Get all the Statuses paginated.
	*
	* @return \Illuminate\Http\Response
	*/
	public function getStatuses()
	{
		$this->statuses = Status::paginate(10);
		return $this->statuses;
	}
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
		return view('module.index')->with('properties', $this->getProperties('', ''))->with('facilities', $this->getFacilities())->with('statuses', $this->getStatuses());
	}
	/**
	* Display all Properties.
	*
	* @return \Illuminate\Http\Response
	*/
	public function listProperties(Request $request)
	{
		$search = $request->search;
		$option = $request->option;
		return view('module.table.properties')->with('properties', $this->getProperties($search, $option));
	}
	/**
	* Display a view for edit Properties.
	*
	* @return \Illuminate\Http\Response
	*/
	public function editProperties()
	{
		return view('module.forms.edit');
	}
	/**
	* Display a view for edit Properties.
	*
	* @return \Illuminate\Http\Response
	*/
	public function showProperties()
	{
		return view('module.forms.show');
	}
	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		return view('module.forms.create');
	}
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
      $validator = Validator::make($request->all(), [
        'title'         => 'required|min:1',
        'address'       => 'required|min:1',
        'town'          => 'required|min:2',
        'country'       => 'required|min:4',
        'status_id'     => 'required',
        'facility_id'   => 'required'
      ]);

      //Si la validación no pasa (se dispara el error 422)
      if ($validator->fails()) {
        $errors = $validator->errors();
        $errors = json_decode($errors);
        //si la petición es vía ajax retorna json
        if (($request->ajax()) || ($request->wantsJson()) || ($request->isJson())) {
			return response()->json(["status_code" => 422, "message" => "Inmueble no creado", "errors" => $errors], 422);
        }
        //return redirect('/properties')->with('message','Inmueble no creado'); //se dispara en vista
      } else {
		DB::beginTransaction();
		try { /* Es creado (201) - Commit */
			$this->property = Property::create(array(
				'title'       => trim(strtoupper($request->get('title'))),
				'description' => trim(strtoupper($request->get('description'))),
				'address'     => trim(strtoupper($request->get('address'))),
				'town'        => trim(strtoupper($request->get('town'))),
				'country'     => trim(strtoupper($request->get('country'))),
				'status_id'   => $request->get('status_id')
			));
			if ($this->property) {
				$this->facilities = $request->get('facility_id');
				foreach ($this->facilities as $key => $value) {
					$this->propertiesFacilities = new PropertyFacility();
					$this->propertiesFacilities->facility_id = $value;
					$this->propertiesFacilities->property_id = $this->property->id;
					$this->propertiesFacilities->save();
				}
			}
			DB::commit();
			return response()->json(["status_code" => 201, "message" => "El Inmueble se ha creado correctamente", "property" => $this->property], 201);
        } catch (Exception $e) { /* No es creado (500) - Rollback */
			DB::rollback();
			return response()->json(["status_code" => 500, "created" => false, "exception" => $e, "message" => "Inmueble no creado"], 500);
        }
      }
	}
	/**
	* Display the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function show(Request $request, $id)
	{
		try {
			$this->property = Property::with('statuses')->findOrFail($id);
			$this->propertiesFacilities = PropertyFacility::with('facilities')->where('property_id', '=',$this->property->id)->get();
			return response()->json(['property' => $this->property, 'propertiesFacilities' => $this->propertiesFacilities], 200);
		} catch (Exception $e) {
			if ($e instanceof ModelNotFoundException) {
				//si la petición es vía ajax retorna json
				if (($request->ajax()) || ($request->wantsJson()) || ($request->isJson())) {
					return response()->json(["status_code" => 404, 'message' => 'Inmueble no encontrado'], 404);
				}
				//return redirect('error/404');//redirecciona a Error Page (GET)
			}
		}
	}
	/**
	* Show the form for editing the specified resource.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function edit(Request $request, $id)
	{
		try {
			$this->property = Property::findOrFail($id);
			$this->propertiesFacilities = PropertyFacility::where('property_id', '=',$this->property->id)->get();
			return response()->json(['property' => $this->property, 'propertiesFacilities' => $this->propertiesFacilities], 200);
		} catch (Exception $e) {
			if ($e instanceof ModelNotFoundException) {
				//si la petición es vía ajax retorna json
				if (($request->ajax()) || ($request->wantsJson()) || ($request->isJson())) {
					return response()->json(["status_code" => 404, 'message' => 'Inmueble no encontrado'], 404);
				}
				//return redirect('error/404');//redirecciona a Error Page (GET)
			}
		}
	}
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'title'         => 'required|min:1',
			'address'       => 'required|min:1',
			'town'          => 'required|min:2',
			'country'       => 'required|min:4',
			'status_id'     => 'required',
			'facility_id'   => 'required'
		]);

		//Si la validación no pasa (se dispara el error 422)
		if ($validator->fails()) {
			$errors = $validator->errors();
			$errors =  json_decode($errors);
			//si la petición es vía ajax retorna json
			if (($request->ajax()) || ($request->wantsJson()) || ($request->isJson())) {
				return response()->json(["status_code" => 422, "message" => "Inmueble no editado", "errors" => $errors], 422);
			}
			//return redirect('/properties')->with('message','Inmueble no editado'); //se dispara en vista
		}
		else {
			DB::beginTransaction();
			try { /* Es editado (200) - Commit */
				$this->property = Property::findOrFail($id);
				$this->property->title = trim(strtoupper($request->get('title')));
				$this->property->description = trim(strtoupper($request->get('description')));
				$this->property->address = trim(strtoupper($request->get('address')));
				$this->property->town = trim(strtoupper($request->get('town')));
				$this->property->country = trim(strtoupper($request->get('country')));
				$this->property->status_id = $request->get('status_id');
				$this->property->save();
				$this->propertiesFacilities = PropertyFacility::where('property_id', '=',$this->property->id)->get();
				if ($this->propertiesFacilities) {
					foreach ($this->propertiesFacilities as $propertyFacility) {
						$propertyFacility->delete();
					}
				}
				if ($this->property) {
					$this->facilities = $request->get('facility_id');
					foreach ($this->facilities as $key => $value) {
						$this->propertiesFacilities = new PropertyFacility();
						$this->propertiesFacilities->facility_id = $value;
						$this->propertiesFacilities->property_id = $this->property->id;
						$this->propertiesFacilities->save();
					}
				}
				DB::commit();
				return response()->json(["status_code" => 200, "message" => "El Inmueble se ha editado correctamente"], 200);
			} catch (Exception $e) {
				DB::rollback();
				if ($e instanceof ModelNotFoundException) {
					return response()->json(["status_code" => 404, "message" => "Inmueble no encontrado"], 404);
				}
				return response()->json(["status_code" => 500, "updated" => false, "exception" => $e, "message" => "Inmueble no actualizado"], 500);
			}
		}
	}
	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
		DB::beginTransaction();
		try {
			$this->property = Property::findOrFail($id);
			$this->propertiesFacilities = PropertyFacility::where('property_id', '=',$this->property->id)->get();
			if ($this->propertiesFacilities) {
				foreach ($this->propertiesFacilities as $propertyFacility) {
					$propertyFacility->delete();
				}
				$this->property->delete();
			}
			DB::commit();
			return response()->json(["status_code" => 200, "message" => "El Inmueble ha sido eliminado"], 200);
		} catch (Exception $e) {
			DB::rollback();
			if ($e instanceof ModelNotFoundException) {
				return response()->json(["status_code" => 404, "message" => "Inmueble no encontrado"], 404);
			}
			return response()->json(["status_code" => 500, "deleted" => false, "exception" => $e, "message" => "Inmueble no eliminado"], 500);
		}
	}
}
