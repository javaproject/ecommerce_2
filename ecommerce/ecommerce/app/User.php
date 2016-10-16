<?php
namespace App;
use App\User;
use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends \Eloquent implements Authenticatable, CanResetPasswordContract
{
  use AuthenticableTrait, CanResetPassword;
  use SoftDeletes;

    public function imageOrder()
    {
        return $this->belongsToMany('App\Image', 'image_user', 'user_id', 'image_id');
    }
    
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function addImage(Image $image)
    {
      return $this->images()->save($image);
    }
    public function images()
    {
      return $this->hasMany('App\Image');
    }
    public function getRole()
    {
      return $this->role->id;
    }
  	public function assignRole(Role $role)
  	{
  		return $this->role()->save($role);
  	}
    public function setDefault()
    {
      $r = Role::where('name','=','client')->get();
      return  $this->role()->assignRole($r);
    }
    public function hasImages()
    {
      return $this->images->count()>0;
    }
    public function isAdmin()
    {
        if ($this->role->name=='admin') {
          return true;
        }
        return false;
    }
    
    protected $dates = ['deleted_at'];
  
	protected $fillable = ['username', 'email', 'password','newpassword_confirmation','newpassword'];

    protected $hidden = [
        'password', 'remember_token',
    ];
     protected $attributes = array(
        'role_id'  => 2,
    );

}
