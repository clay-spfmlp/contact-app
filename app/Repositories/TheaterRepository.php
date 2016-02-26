<?php

namespace App\Repositories;

use App\Movies\Theaters;

class TheaterRepository 
{

	protected $theater;

	public function __construct(Theaters $theaters)
	{
		$this->theater = $theater;
	}
	
	public function getTheaters($zipCode = 78217)
	{
		// if(!$zipCode) {dd('need zipCode')}

		return $this->theater->all($zipCode);
	}

}