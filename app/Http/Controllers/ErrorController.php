<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    /**
     * Display a page of the error 404.
     *
     * @return \Illuminate\Http\Response
     */
    public function error404()
    {
        return view('errors.404');
    }
}
