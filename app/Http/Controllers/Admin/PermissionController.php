<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Permission};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class PermissionController extends Controller
{

    function __construct(){
         $this->middleware('permission:permission-list|permission-create|permission-edit|permission-delete', ['only' => ['index','show']]);
         $this->middleware('permission:permission-create', ['only' => ['create','store']]);
         $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    // -- Manage Permission
    public function index() {

        $list = Permission::orderBy('id','DESC')->get();
        return view('admin.permission.index',compact('list'));
    }

    //---Create Permission
    public function create(Request $request) { 
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'name'        => 'required',
                'guard_name'  => 'required',
            ]);

           $user = Permission::create($data);
           return redirect('manage_permission')->withFlashSuccess('Permission added successfully');
            
        }
        return view('admin.permission.create');      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update Permission
    public function update(Request $request,$id=null) {
        
        if(isset($id)){
            $editview = Permission::where('id', $id)->first(); 
        }else{
            $editview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'name'       => 'required',
                'id'         => '',
            ]);

            
            if(isset($data['id'])){
                $user = Permission::find($data['id']);
                $user->update($data);
                return redirect('manage_permission')->withFlashSuccess('Permission updated successfully');
            } 
        }
        //print_r($userRole); die;
        return view('admin.permission.edit',compact('editview'));      
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}