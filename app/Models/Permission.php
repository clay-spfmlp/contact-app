<?php 

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = [
        'name',
        'display_name',
        'category',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}