<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

	protected $fillable = [
		'name',
		'email',
		'phone',
		'birthday',
	];

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

    /**
     * The user that belong to the contact.
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

}
