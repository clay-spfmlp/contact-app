<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
	
	private $permission;

	private $role;

	public function __construct(Permission $permission, Role $role)
	{
		$this->permission = $permission;
		$this->role = $role;
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.permission.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$input = $request->all();
    	$input['slug'] = $input['name'];
        return $this->permission->create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    	
        $permission = $this->permission->find($id);
        $permission->name = $request->get('name');
        $permission->slug = $request->get('name');
        $permission->model = $request->get('model');
        $permission->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function permissions()
    {
    	$permissions = $this->permission->with('roles')
    						->orderBy('model')
    						->get();

    	$grouped = $permissions->groupBy(function($item, $key){
    		$model = explode('\\', $item['model']);
    		return array_pop($model);
    	});

    	//dd($grouped);

    	return $grouped;
    }

    public function roles()
    {
    	return $this->role->with('permissions')->get();
    }

    public function updateRole(Request $request)
    {
    	$ids = $request->get('ids');
    	$roles = $this->role->all();

    	if($ids){
    		foreach ($ids as $key => $value) {
    			$idi[$key] = explode(".", $value);
    			$id[$idi[$key][1]][$key] = $idi[$key][0];
    		}

    		foreach ($roles as $role) {
    			if( array_key_exists($role->id, $id)){
    				$role->permissions()->sync($id[$role->id]);
    			} else {
    				$role->detachAllPermissions();
    			}	
    		}
    		return 'true';
    	}

    	foreach ($roles as $role) {
    		$role->detachAllPermissions();
    	}
    	return 'true';
    }
	
}
