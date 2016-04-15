<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Equilibrium\Equilibrium;

class EquilibriumController extends Controller
{

	public function __construct(Equilibrium $equilibrium){
		$this->equilibrium = $equilibrium;
	}
    
    public function index() {
    	return view('equilibrium.index');
    }

    public function equilibrium(Request $request) {
    	return $this->equilibrium->getEquilibriumsSteps($request->get('equilibrium'));
    }

}