<?php 

namespace App\Traits;

trait VueHelper 
{

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

	public function getGravatarAttribute()
    {
        return $this->gravatar = md5(strtolower(trim($this->email)));
    }

    public function getCheckedAttribute()
    {
        return $this->checked = false;
    }
	
}