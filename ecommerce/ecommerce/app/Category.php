<?php

namespace App;
use App\Album;
use Illuminate\Database\Eloquent\Model;

class Category extends Model 
{
	public $timestamps = false;
		
	public function albums()
		{
			return $this->hasMany('App\Album');
		}	
	public function isActive()
	{
		return $this->active;
	}
	public function addAlbum(Album $album)
	{

		return	$this->albums()->save($album);
	}	
	
	
    public function hasAlbums()
    {
        if($this->albums->count() > 0)
        {
            return true;
        }
        return false;
    }
    public function hasActiveAlbums()
    {
		
		$id = $this->id;
		$k = $this->join('albums', function($join) use ($id) {
		    $join->on('albums.category_id', '=', 'categories.id') 

		      ->where('categories.id', '=', $id)
		      ->where('albums.active', '=',1)
		      ->where('categories.active', '=', 1);
		  })->count();
		if($k>0)
		{
			return true;
		}else{return false;}
    }
                



	protected $fillable = ['name', 'description', 'thumbnail','active'];
}
