<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ModelDetails\ModelDetails;

class AdminController extends Controller
{

	//private $model;

    public function index()
    {
    	return view('admin.index');
    }

    public function modelDetails(ModelDetails $model)
    {
    	return $model->permission;
    }
}
