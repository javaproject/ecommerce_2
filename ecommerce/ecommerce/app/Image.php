<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Image extends Model
{
	public $timestamps = false;

    public function userOrder()
    {
        return $this->belongsToMany('App\User', 'image_user', 'image_id', 'user_id');
    }

    public function active()
    {
        return $this->active;
    }
    public function album()
    {
    	return $this->belongsTo('App\Album');
    }
    public function getAlbum()
    {
        return $this->album_id;
    }
    public function user()
    {
    	return $this->belongsTo('App\User');
    }
    public function free()
    {
         //$img->contains('album_id',0);
        return ($this->album_id == 0);
    }
    public function showImage()
    {

         return (Auth::user()->isAdmin() || ($this->user_id==Auth::user()->id

                    || $this->active()) );

    }

    public function editImage()
    {
        return Auth::user()->isAdmin() || ($this->user->id==Auth::user()->id);
    }
    public function activate()
    {
         $this->active=1;
         $this->save();
    }
     public function deactivate()
    {
         $this->active=0;
         $this->save();
    }
   /* public function usersImages()
    {
        return $images=Image::where('active',1)
                ->orWhere('user_id','=',Auth::user()->id)
                ->get();
    }*/
 
}
