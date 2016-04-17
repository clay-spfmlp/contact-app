<?php

namespace App\Models;

use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasRoleAndPermissionContract
{

    use HasRoleAndPermission;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The roles that belong to the user.
     * 
     * @return App\Models\Role
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * The contacts that belong to the user.
     */
    public function contacts()
    {
        return $this->belongsToMany('App\Models\Contact')->with('labels');
    }

    /**
     * The labels that belong to the user.
     */
    public function labels()
    {
        return $this->belongsToMany('App\Models\Label')->with('contacts');
    }

}
