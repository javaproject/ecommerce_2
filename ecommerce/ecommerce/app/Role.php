<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Role extends \Eloquent
{
	protected $fillable = ['name', 'description'];
 
    public function users()
    {
        return $this->hasMany('App\User');
    }
    public function addUser(User $user)
    {
   		return	$this->users()->save($user);
    }
    public function hasUsers()
    {
       return $this->users->count()> 0;
    }
    public function getUsers()
    {
      return  $this->users()->get();
    }
    
}
