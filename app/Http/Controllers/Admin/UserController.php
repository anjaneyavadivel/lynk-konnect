<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Company,State};;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Session;

class UserController extends Controller
{

    
    function __construct(){
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    //-- Registration company
    public function signUp(Request $request) { 
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'name'       => 'required|regex:/(^[A-Za-z ]+$)+/|string|max:20',
                'email'      => 'email|unique:users,email|',
                'password'   => 'required',
                'company_id' => 'required',
                'role_id'    => 'required',
            ],[
                'name.regex' => 'Charater and space only allowed',
            ]);

            #---- Pro-Pic --
            if($request->file('image') != ''){ 
                $file   = $request->file('image');
                $name   = explode('.', $file->getClientOriginalName());
                $name   = 'images/' . $name[0];
                
                $data['image'] = Helpers::uploadFileToAWS($file, $name . "_" . Carbon::now());
            }
          #---End Pro-Pic --
           $data['password'] = Hash::make($data['password']);

           $user = User::create($data);
           $user->assignRole($data['role_id']);
               //$user = User::create($request->except('parish_id','submit'));
               //$id   = DB::getPdo()->lastInsertId();
          
               #----- Mail credentails to admin users
               
                $name = $data['name'];;
                $mail = $data['email'];
                //$reply_text = $data['reply_text'];
                $password = rand(1, 1000000);
                //Mail::to($mail)->send(new AdminCredentailsMail($name,$password));
               #----- End of Mail credentails to admi users
               
               return redirect('signup')->withFlashSuccess('Activation link send to your email  !!');
        }
        return view('admin.users.signup');      
    }
    
    // -- Manage Users
    public function index() {
        $company_id_s = Session::get('company_id_s');  

        //$list = User::orderBy('id','DESC')->get();
        $list = User::getUsers($company_id_s);
        //dd($list);
        return view('admin.users.index',compact('list'));
    }

    //---Create User
    public function create(Request $request,$id=null) { 
        
        $roleList     = Role::orderBy('name', 'ASC')->get(); 
        $companyList  = Company::orderBy('company_name', 'ASC')->get();  
        $stateList    = State::orderBy('state_name', 'ASC')->get(); 
        if(isset($id)){
            $editview = User::where('id', $id)->first(); 
        }else{
            $editview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'fname'      => 'required|regex:/(^[A-Za-z ]+$)+/|string|max:20',
                'lname'      => '',
                'email'      => 'email|unique:users,email|',
                'password'   => 'required',
                'company_id' => 'required',
                'role_id'    => 'required',
                'id'         => '',

            ],[
                'fname.regex' => 'Charater and space only allowed',
                
            ]);

           
            if(isset($data['id'])){

                
                $user = User::find($data['id']);
                $user->update($data);
                DB::table('model_has_roles')->where('model_id',$data['id'])->delete();
                $user->assignRole($data['role_id']);
               // return redirect('manage_users')->withFlashSuccess('User updated successfully');
                  return redirect('manage_users')->with('success','User updated successfully!');
            }else{
              #---- Pro-Pic --
            if($request->file('image') != ''){ 
                $file   = $request->file('image');
                $name   = explode('.', $file->getClientOriginalName());
                $name   = 'images/' . $name[0];
                
                $data['image'] = Helpers::uploadFileToAWS($file, $name . "_" . Carbon::now());
            }
          #---End Pro-Pic --
           $data['password'] = Hash::make($data['password']);

           $user = User::create($data);
           $user->assignRole($data['role_id']);
               //$user = User::create($request->except('parish_id','submit'));
               //$id   = DB::getPdo()->lastInsertId();
          
               #----- Mail credentails to admin users
               
                $name = $data['fname'];;
                $mail = $data['email'];
                //$reply_text = $data['reply_text'];
                $password = rand(1, 1000000);
                //Mail::to($mail)->send(new AdminCredentailsMail($name,$password));
               #----- End of Mail credentails to admi users
               
               return redirect('manage_users')->withFlashSuccess('User added successfully');
            } 
        }
        return view('admin.users.create',compact('editview','roleList','companyList','stateList'));      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update User
    public function update(Request $request,$id=null) {
        
        $roleList     = Role::orderBy('name', 'ASC')->get(); 
        $companyList  = Company::orderBy('company_name', 'ASC')->get();  

        if(isset($id)){

            $user = User::find($id);
            $userRole = $user->roles->pluck('id')->all();
            
            $editview = User::where('id', $id)->first(); 
        }else{
            $editview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'fname'      => 'required|regex:/(^[A-Za-z ]+$)+/|string|max:20',
                'lname'      => '',  
                'email'      => 'required|email',
                'password'   => 'required',
                'company_id' => 'required',
                'role_id'    => 'required',
                'id'         => '',

            ],[
                'fname.regex' => 'Charater and space only allowed',
                
            ]);

            
            if(isset($data['id'])){
            #---- Pro-Pic --
            if($request->file('image') != ''){ 
                $file   = $request->file('image');
                $name   = explode('.', $file->getClientOriginalName());
                $name   = 'images/' . $name[0];
                
                $data['image'] = Helpers::uploadFileToAWS($file, $name . "_" . Carbon::now());
            }
            #---End Pro-Pic --
            
            
                $data['password'] = Hash::make($data['password']);
            
                

                $user = User::find($data['id']);
                $user->update($data);
                DB::table('model_has_roles')->where('model_id',$data['id'])->delete();
                $user->assignRole($data['role_id']);
                return redirect('manage_users')->withFlashSuccess('User updated successfully');
            } 
        }
        //print_r($userRole); die;
        return view('admin.users.edit',compact('editview','userRole','roleList','companyList'));      
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}