<?php
namespace App\Http\Controllers;
use App\User;
use App\Role;
use File;
use Session;
use Auth;
use Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

class UserController extends Controller
{    
      public function __construct()
    {
        $this->middleware('AdminMiddleware');
    }
    public function index()
    {
        //$users = User::withTrashed()->get();
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }
    public function create()
    {
            $roles = Role::all();
            return view('admin.users.create')->with('roles', $roles);;
    }
     public function store(Request $req)
    {
                $this->validate($req, [ 
                'username' =>  'required|regex:/^[\pL\s\-]+$/u|min:4|max:50|unique:users',   
                'email' => 'required|email|max:32|unique:users',
                'password' => 'required|min:7|confirmed',
            ]);

               $user =  new User([
                  'username' => $req['username'],
                  'email' => $req['email'],
                  'password' => bcrypt($req['password']),
                ]);
               $get_role= $req['role_id'];
                $role = Role::where('id', '=', $get_role)->first();
                $role->addUser($user);
                
           Session::flash('user_created','User Added Successfully !');
           return redirect()->route('user.index');       
    }

        public function show(User $user)
        {
            return view('admin.users.show', compact('user'));
        }
         public function edit(User $user)
        {
          
                  $arr = [
                      'user' => $user,
                      'roles' => Role::all()
                ];
               return view('admin.users.edit')->with('arr', $arr); 

        }
         public function update(Request $req,User $user)
        {

            $this->validate($req, [ 
                
                'role_id' => 'required'
            ]);         
             if($user->role->id == $req->role_id)
             {
                  return redirect()->route('user.index');
             }else{

                    $role_id = Role::where('id', '=', $req->role_id)->first();
                    $user= User::find($user->id);
                    $role_id->addUser($user);
                    $user->save();
                     
                    Session::flash('user_updated', 'User Successfully Updated');
                    return redirect()->route('user.index');
             }
                  
        }
         public function destroy(User $user)
          {
            $path = '/uploads/images/';
         
              if($user->hasImages())
              {
                foreach ($user->images as $image) {
                  $p = $image->path;
                File::Delete(public_path($path.$image->path));
                $image->delete();
                }
              }
              $user->delete();
              Session::flash('user_deleted', 'User Successfully Deleted');
              return redirect()->route('user.index');
          }

        /************RESET PASSWORD************/

    public function reset_pass()
    {
        return view('auth.reset_password');
    }

    public function reset_submit()
    {
        $input = Input::except('_token');
        $rules = array(
            'current_password' => 'required',
            'newpassword' => 'required|min:7|different:current_password|confirmed');

        $validator = Validator::make($input, $rules);

        if (!Hash::check($input['current_password'], Auth::user()->password))
        {
            $validator->errors()->add('current_password', 'Current password wont match !');
            return back()->withErrors($validator);
        }else{

            if (!$validator->passes())
            {
                return back()->withErrors($validator);
            }
            else
            {
                Auth::user()->password = bcrypt($input['newpassword']);
                Auth::user()->save();

                Auth::logout();
                Session::flush();
                return redirect('login')->with('pass_update', 'Password changed, please login again!');
            }
        }
    }
    public function change_password()
    {
        
        return view('auth.reset_password');
    }
    
}
