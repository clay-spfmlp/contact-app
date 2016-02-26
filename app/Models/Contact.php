<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

	protected $appends = array('gravatar');

	public function getGravatarAttribute()
    {
        return $this->gravatar = md5(strtolower(trim($this->email)));
    }

    /**
     * The contacts that belong to the user.
     */
    public function labels()
    {
        return $this->belongsToMany('App\Models\Label');
    }

}
