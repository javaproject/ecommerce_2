<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Album;
use App\Image;
use Session;
use File;
use Auth;
use App\Category;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class AlbumController extends Controller
{
    public function index()
    {   

        if(Auth::user()->isAdmin())
        {
           
         return view('admin.albums.index')->with('albums', Album::paginate(6));
        }
        else 
        {
            $albums = Album::with('category')->whereHas('category', function($query){
                        $query->where('active', 1);
                    })->where('active', 1)->paginate(6);

                if(!$albums)
                {
                  return back()->with('no_albums_active','Sorry, no ACTIVE albums');
                }
                return view('admin.albums.index')->with('albums', $albums);
        }
        
    }

    public function create()
    {

       $categories = Category::all();
      
     return view('admin.albums.create')->with('categories',$categories);
    }

    public function store(Request $req)
    {
        $this->validate($req, [ 
                'name' => 'required|min:3|max:32|unique:albums',  
                'description' => 'required|min:3|max:32', 
                'thumbnail' => 'required|image|mimes:jpeg,jpg,gif,png, bmp|max:1048576',
                'category_id' => 'required|integer'
            ]);

            if($req->hasFile('thumbnail'))
            {

           $file = $req->file('thumbnail');
           $thumbnail = time(). '.'.$file->getClientOriginalExtension();
           \Image::make($file)->resize(500,500)->save(public_path('/uploads/images/'.$thumbnail));

                $al = new Album;
                $al->name = $req->name;
                $al->description = $req->description;
                $al->thumbnail = $thumbnail;
                $al->category_id = $req->category_id ;
                
                ($req->act=='Active')? $al->active=1 : $al->active=0;
                $al->save();
            
            Session::flash('album_created', 'Album Successfully Created !');
            //return redirect()->route('album.index');

         return view('admin.albums.index')->with('albums', Album::paginate(6));
            }
    }
    public function show(Album $album)
    {        
        
            if($album->hasImages())
            {   //kontrrolli nqs 1 usr dht lejuar per te pare nje album behet ne view
                $k = $album->id;
                $images = Image::with('album')->whereHas('album', function($q) use($k)
                {
                    $q->where('id', $k);
                })->paginate(8);
                return view('admin.albums.show', ['images' => $images]);         
            }
            else
            {
             return back()->with('no_images', 'No images in this album');
            }
    }
   
    public function edit(Album $album)
    {
        $categories = Category::all();
        $arr = ['categories' => $categories,
                 'album' => $album
        ];
        return view('admin.albums.edit',['arr' => $arr]);
    }

    public function update(Request $req, Album $album)
    {
        $this->validate($req, [ 
                'name' => 'required|min:3|max:32|unique:albums,name,'.$album->id,  
                'description' => 'required|min:3|max:32', 
                'thumbnail' => 'image|mimes:jpeg,jpg, gif, png, bmp|max:1048576',
                'category_id' => 'required|integer',
            ]);
        $th = false;
           if($req->hasFile('thumbnail'))
            {   $th = true;
                //first we delete the old image 
                $path = '/uploads/images/';
                File::Delete(public_path( $path . $album->thumbnail)); 
                //S$album->thumbnail->delete();

                $file = $req->file('thumbnail');
                $thumbnail = time(). '.'.$file->getClientOriginalExtension();
                \Image::make($file)->resize(500,500)->save(public_path('/uploads/images/'.$thumbnail));
                 $album->thumbnail = $thumbnail;
            }
                if($album->name != $req->name || $album->description != $req->description
                || $th || ($req->act=='Active' && $album->active==0)
                || ($req->act=='Not active' && $album->active==1) 
                || $req->category_id != $album->category_id )
                {
                   $album->name = $req->name;
                $album->description = $req->description;
                $album->category_id = $req->category_id;
                ($req->act=='Active')? $album->active=1 : $album->active=0;
                $album->save();

         Session::flash('album_updated', 'Album Successfully Updated !');
     
         return view('admin.albums.index')->with('albums', Album::paginate(6));
                }
            
            
        
         return view('admin.albums.index')->with('albums', Album::paginate(6));
    }
    public function destroy(Album $album)
    {
        $path = '/uploads/images/';
      if($album->hasImages())
      {
        $imgs= $album->images;
        
        foreach($imgs as $img)
        {   $p = $img->path;
           File::Delete(public_path( $path . $img->path));
           $img->delete();
        }
    }
        File::Delete(public_path( $path . $album->thumbnail));  
        $album->delete();
        Session::flash('album_deleted', 'Album Successfully Deleted');
        return view('admin.albums.index')->with('albums', Album::paginate(6));
    }
     public function removeImage(Image $image)
    {//me pas admin mund ta modifikoje duke i percaktuar nje tjeter album
         $image->album_id=null;
         $image->save();
         Session::flash('image_removed', 'Image Removed !');
         return back();
    }
}
