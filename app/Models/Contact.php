<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{

	use SoftDeletes;

	protected $fillable = [
		'name',
		'email',
		'phone',
		'birthday'
	];

	protected $appends = array('gravatar', 'checked');

	public function getGravatarAttribute()
    {
        return $this->gravatar = md5(strtolower(trim($this->email)));
    }

    public function getCheckedAttribute()
    {
        return $this->checked = false;
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
