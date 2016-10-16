<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use Auth;
use Session;
use App\Album;
use File;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;


class CategoryController extends Controller
{

    public function index()
    {
        
            if( !Auth::user()->isAdmin())
            {
               $categories = Category::where('active',1)->paginate(6);
            }
            else{
                $categories = Category::paginate(6);
            }
        
       return view('admin.categories.index', ['categories' => $categories ]);   
    }
    public function create()
    {   
            
     return view('admin.categories.create');
        
    }

    public function store(Request $req)
    {
        $this->validate($req, [ 
                'name' => 'required|min:3|max:32|unique:categories',  
                'description' => 'required|min:3|max:32', 
                'thumbnail' => 'required|image|mimes:jpeg,jpg,gif,png, bmp|max:1048576',
            ]);

            if($req->hasFile('thumbnail'))
            {
                $file = $req->file('thumbnail');
                $thumbnail = time(). '.'.$file->getClientOriginalExtension();
                \Image::make($file)->resize(500,500)->save(public_path('/uploads/images/'.$thumbnail));

                $cat = new Category;
                $cat->name = $req->name;
                $cat->description = $req->description;
                $cat->thumbnail = $thumbnail;
                ($req->act=='Active')? $cat->active=1 : $cat->active=0;
                $cat->save();
            
            Session::flash('category_created', 'Category Successfully Created !');
            return view('admin.categories.index')->with('categories', Category::paginate(6));
            }
    }
    public function show(Category $category)
    {
           
                if(Auth::user()->isAdmin())
                {       
                    if($category->hasAlbums())
                    {
                        $cat_id = $category->id;
                         $albums = Album::with('category')->whereHas('category', function($q) use($cat_id)
                         {
                        $q->where('id', $cat_id);
                        })->paginate(8);

                    return view('admin.categories.show',['albums' => $albums]);
                    }else{
                         return back()->with('no_albums','Sorry, no albums in this category');
                    }
                }
                else
                {
                    if($category->isActive())
                    {  
                        if($category->hasActiveAlbums())
                        {
                        $cat_id = $category->id;
                         $albums = Album::with('category')->whereHas('category', function($q) use($cat_id)
                         {
                        $q->where('id', $cat_id);
                        })->where('active',1)->paginate(8);

                        return view('admin.categories.show',['albums' => $albums]);
                        }else{

                            return back()->with('no_albums_active','Sorry, no ACTIVE albums in this category'); 
                        }
                    }
                }        
    }    

    public function edit(Category $category)
    {
        return view('admin.categories.edit',['category'=> $category]);
    }

    public function update(Request $req,Category $category)
    {     
        $this->validate($req, [ 

                'name' => 'required|min:3|max:32|unique:categories,name,'.$category->id,  
                'description' => 'min:3|max:32', 
                'thumbnail' => 'image|mimes:jpeg,jpg,gif,png, bmp|max:1048576',
            ]);


           if($req->hasFile('thumbnail'))
            {
                $file = $req->file('thumbnail');              
                $path = '/uploads/images/';
                //first we delete the old image 
 File::copy(public_path( $path . $category->thumbnail), 
    public_path( '/deleted/images/' . $category->thumbnail));
                 File::delete(public_path( $path . $category->thumbnail)); 
            
                $thumbnail = time(). '.'.$file->getClientOriginalExtension();
                \Image::make($file)->resize(500,500)->save(public_path('/uploads/images/'.$thumbnail));
                 $category->thumbnail = $thumbnail;
            }
                if($category->name != $req->name || $category->description != $req->description
                || $req->hasFile('thumbnail') || ($req->act=='Active' && $category->active==0)
                || ($req->act=='Not active' && $category->active==1) )
                {
                   $category->name = $req->name;
                $category->description = $req->description;
                
                ($req->act=='Active')? $category->active=1 : $category->active=0;
                $category->save();
                  Session::flash('category_updated', 'Category Successfully Updated !');
                }
            
           return view('admin.categories.index',['categories' => Category::paginate(6)]);       
    }
    
    public function destroy(Category $category)
    {
        $path = '/uploads/images/';

       if($category->hasAlbums())
       {
        foreach($category->albums as $a)
        {
                    if($a->hasImages())
                    {
                        foreach($a->images as $img)
                        {
                         File::Delete(public_path( $path . $img->path));
                         $img->delete();
                        }
                    }
                  File::Delete(public_path( $path . $a->thumbnail));    
                  $a->delete();
            }
        }
        File::Delete(public_path( $path . $category->thumbnail));
        $category->delete();
       Session::flash('category_deleted','Category Successfully deleted');
     return view('admin.categories.index',['categories' => Category::paginate(6)]); 
    
    }
    public function removeAlbum(Album $album)
    {
         $album->category_id=null;
         $album->save();
         Session::flash('album_removed','Album Removed !');
         return back();
    }
}
