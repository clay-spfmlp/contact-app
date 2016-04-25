<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\VueHelper;

class Label extends Model
{

	use SoftDeletes, VueHelper;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

	protected $appends = array('updating', 'editing', 'remove');

    /**
     * The contacts that belong to the label.
     */
    public function contacts()
    {
        return $this->belongsToMany('App\Models\Contact');
    }

    /**
     * The user that belong to the label.
     */
    public function user()
    {
        return $this->belongsToMany('App\Models\User');
    }

}
