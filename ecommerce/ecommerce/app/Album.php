<?php

namespace App;
use App\Category;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    	
    public function category()
    {
    	return $this->belongsTo('App\Category');
    }
    
    public function images()
	{
		return $this->hasMany('App\Image');
	}	
    
    public function addImage(Image $image)
    {

        return  $this->images()->save($image);
    }

    public function hasImages()
    {
        if($this->images->count() > 0)
        {
            return true;
        }
        else{
            return false;
        }
        
    }
    public function getCategory()
    {

        return $this->category
        ;
    }
	public function isActive()
	{
		return $this->active;
	}
    public function hasActiveImages()
    {      
        $id = $this->id;

         $images = Image::with('album')->whereHas('album', function($q) use ($id )
                {
                    $q->where('id', $id);
                })->where('active',1)->count();
        if($images>0)
        {
            return true;
        }else{return false;}
    }
    public function showAlbum()
    {
       return  $this->isActive() && $this->getCategory()->isActive();
    }
	
	protected $fillable = ['name', 'description', 'thumbnail','active'];

    public $timestamps = false;

}
