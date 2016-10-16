<?php
namespace App\Http\Controllers;
use App\User;
use App\Role;
use Session;
use Auth;
use Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

class RoleController extends Controller
{
     public function index()
    {       
        $roles = Role::all();
        return view('admin.roles.index')->with('roles', $roles);
    }

     public function store(Request $request)
    {

        if ($request->isMethod('post')) {
              
            $r = new Role();
            //$note = new Note($req->all());
             $r->name= $request->input('name');
               $r->description= $request->input('description');
               $r->save();
               Session::flash('role_created','Role Created Successfully !');
               return response()->json(['success' => true]);

        }      
    }

    public function show(Role $role)
    {
      return view('admin.roles.show', compact('role') );
    }

    public function edit(Role $role)
    {
       return view('admin.roles.edit', compact('role'));
    }
    public function update(Request $request, Role $role)
    {
      //$roles = Role::all();
      if($request->description == $role->description && $request->name == $role->name){
        //$role->update($request->all());
      return redirect()->route('role.index');
      }
      else
      {
          $this->validate($request, [ 
       'name' =>  'required|min:4|max:32',   
      'description' => 'required|min:4|max:32',
            ]);
             
       $role->update($request->all());
       $role->save();
       Session::flash('role_updated', 'Successfully Updated');
       return redirect()->route('role.index');
      }
    
  }
    public function destroy(Role $role)
    {
          if(count($role->getUsers())==0)
          {
            $role->delete();
            Session::flash('role_deleted', 'Successfully Deleted');
            return redirect()->route('role.index');
          }
            else{
                $r = Role::find(2);
                foreach($role->getUsers() as $key=>$value ) {

                        $r->addUser($value);
                    
                }
                $role->delete();
                 return back()->with('change_role', 'USERS ASSIGNED THIS ROLE NOWHAVE  CLIENT ROLE ');

            }
    }
}
