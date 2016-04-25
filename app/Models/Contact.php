<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\VueHelper;

class Contact extends Model
{

	use SoftDeletes, VueHelper;

	protected $fillable = [
		'name',
		'email',
		'phone',
		'birthday'
	];

	protected $appends = array('gravatar', 'checked');

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
