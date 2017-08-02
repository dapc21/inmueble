<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;

class LogController extends Controller
{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    /**
     * Display Login.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('index');
    }

    /**
     * Login users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(LoginRequest $request)
    {
        if(Auth::attempt(['username'=>trim(strtoupper($request['username'])), 'password'=>$request['password']])) {
            if ($request->ajax()) {
                return response()->json(['message' => 'OK'], 200);
            } else {
                return Redirect::intended('api');
            }
        }
        else {
            if ($request->ajax()) {
                return response()->json(['message' => 'NOT_FOUND'], 401);
            } else {
                return Redirect::to('/');
            }
        }
    }
    /**
     * Logout users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function logout(Request $request){
        $this->validate($request, ['token' => 'required']);
        Auth::logout();
        if ($request->ajax()) {
            return response()->json(['message' => 'OK'], 200);
        } else {
            return Redirect::to('/');
        }
    }
 
}
