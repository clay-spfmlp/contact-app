<?php

namespace App\ModelDetails;

class ModelDetails 
{
	//private $filename;

	private $names;

	private $namespaces;

	public $permission;

	private $path;


	public function __construct()
	{
		$this->path = config('app.modelpath');

	    $i = 0;
	    $results = $this->getFiles();
	    foreach ($results as $result) {
	        if (in_array($result, $this->getIngore())) continue;

	        $this->names[$i] = substr($result,0,-4);
	        $this->namespaces[$i] = config('app.modelnamespace').$this->names[$i];

	        $this->permission[$i]['name'] = $this->names[$i];
	     	$this->permission[$i]['namespace'] = $this->namespaces[$i];
	     	$i++;
	    }
	}

	private function getFiles()
	{
		return scandir($this->path);
	}

	private function getIngore()
	{
		return ['.', '..', '.DS_Store'];
	}

}