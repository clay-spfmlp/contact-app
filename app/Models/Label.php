<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{

	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

	protected $appends = array('updating', 'editing', 'remove');

	public function getUpdatingAttribute()
    {
        return $this->updating = false;
    }

	public function getEditingAttribute()
    {
        return $this->editing = false;
    }

    public function getRemoveAttribute()
    {
        return $this->remove = false;
    }

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
