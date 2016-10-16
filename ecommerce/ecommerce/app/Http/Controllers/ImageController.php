<?php
namespace App\Http\Controllers;
use League\Flysystem\Exception;
use Session;
use Gate;
use Illuminate\Http\Request;
use App\Image;
use App\Album;
use App\Cart;
use File;
use Validator;
use Auth;
use App\Http\Requests;
use Stripe\Stripe;
use Stripe\Charge;
class ImageController extends Controller
{
    public function index()
    {       
       if(Auth::user()->isAdmin())
       {
        return view('admin.images.index')->with('images', Image::paginate(6));
        }else
        {
         $images = $images=Image::where('active',1)
                ->orWhere('user_id','=',Auth::user()->id)
                ->paginate(6);
            return view('admin.images.index')->with('images', $images);
        }
    }
    public function create()
    {
        return view('admin.images.create', array('user'=>Auth::user()));
    }
    public function store(Request $request)
    {

           if($request->hasFile('path'))
           {
                   /*$data = $request->all();
                    var_dump($data);*/
                       $file = $request->file('path');
                       $p = time(). '.'.$file->getClientOriginalExtension();
                       \Image::make($file)->resize(450,450)->save(public_path('/uploads/images/'.$p));
                          $img = new Image;
                          $img->path = $p;
                        Auth::user()->addImage($img);
                        $img->name = $request->input('name');
                        $img->price = $request->input('price');
                        $img->quantity = $request->input('quantity');
                        $img->album_id = $request->input('album_id');
                        $img->save();

               return response()->json(['success' => true]);
            }
            else
            {
                return response()->json(['error' => true]);
            }
            
    }
    public function show(Image $image)
    {
        return view('admin.images.show', ['image' => $image]);
    }

    public function edit(Image $image)
    {
        if (Gate::denies('edit-image',$image)) {
            abort(403,'Not authorized to update!');            
        }
        $albums  = Album::all();
        $arr = ['image'=> $image,
                 'albums' => $albums   
                ];
       return view('admin.images.edit',['arr'=>$arr]);
       
    }
   
    public function update(Request $req, Image $image)
    {  $change = 0;
        if(($req->act == 'Active' && $image->active==0) || ($req->act == 'Not active' && $image->active==1))
        {
            $change = true;
        }
        if($req->act=='Active')
        {   
             $image->active = 1;
             $image->save();
        }
        if($req->act=='Not active')
        {
             $image->active = 0;
             $image->save();
        }
       
            $this->validate($req, [ 
               'name' => 'required|min:4|max:32| 
               unique:images,name,'.$image->id,  
            ]);
        
            if( ($image->name != $req->name) || ($req->album_id != $image->album_id) || $change)
            {
                 $image->name = $req->name;
                $image->album_id = $req->album_id;
                $image->save();
                Session::flash('image_updated', 'Image Successfully Updated');
                return redirect()->route('image.index');
            }else{
                  return redirect()->route('image.index');  
         }     
    }
    public function destroy(Image $image)
    {
         $path = '/uploads/images/';
           $p = $image->path;
           File::Delete(public_path($path.$image->path));
         
        
        $image->delete();
        // return 'success';
       return back()->with('image_deleted','Image Deleted Successfully');

    }
    public function addImageToCart(Request $req, Image $image)
    {
        $c = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($c);
        $cart->addImage($image);
        $req->session()->put('cart', $cart);

        return back();
    }
    public function getShoppingCart()
    {
        if(!Session::has('cart'))
        {
            return view('admin/images.shopping_cart', ['images' => null]);
        }
        $c = Session::get('cart');
        $ct = new Cart($c);
        return view('admin/images.shopping_cart', ['images' => $ct->images,
                                                    'totPrice' => $ct->totPrice,
                                                    ]
        );
    }

    public function getCheckout()
    {
        if(!Session::has('cart'))
        {
            return view('admin/images.shopping_cart', ['images' => null]);
        }
        $cart = Session::get('cart');
        $newCart = new Cart($cart);

        $totPrice = $newCart->totPrice;
        return view('admin/images.checkout', ['total' => $totPrice]);
    }
    public function postCheckout(Request $req)
    {

        if(!Session::has('cart'))
        {
            return redirect()->back();
        }
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);

        //on back-end we set the private key
        Stripe::setApiKey('sk_test_B00D8AmIQM0ULB65WlUp1wqe');
        try{
            Charge::create(array(
                "amount" => $cart->totPrice * 100,
                "currency" => "usd",
                "source" => $req['stripeToken'], // obtained with Stripe.js
                "description" => "Test Charge"
            ));
        }catch(\Exception $e)
        {
            return redirect()->route('checkout')->withError($e->getMessage());
        }
        //bsc we cheked out; !!
        Session::forget('cart');

        return redirect()->back();
    }
}
