<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Movies\Theater;


class TheaterController extends Controller
{
	protected $theater;
    
    public function __construct(Theater $theater)
    {
    	$this->theater = $theater;
    }

	public function getTheaters($zipCode = 78217)
	{
		$result = $this->theater->all($zipCode);

		//dd($result);

		return response()->json($result);
	}

}
