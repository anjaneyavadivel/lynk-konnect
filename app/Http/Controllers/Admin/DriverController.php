<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Driver,State,Company,City};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Auth;
use Illuminate\Support\Arr;

class DriverController extends Controller
{

    function __construct(){
         $this->middleware('permission:driver-list|driver-create|driver-edit|driver-delete', ['only' => ['index','show']]);
         $this->middleware('permission:driver-create', ['only' => ['create','store']]);
         $this->middleware('permission:driver-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:driver-delete', ['only' => ['destroy']]);
    }

    // -- Manage Driver
    public function index() { 

        $list = Driver::orderBy('id','DESC')->get();
        //$list = Company::getCompany();
        return view('admin.driver.index',compact('list'));
    }

    //---Create Driver
    public function create(Request $request) { 
       
      $stateList    = State::orderBy('state_name', 'ASC')->get();   
        if($request->has('_token')){   
            $user_info=Auth::user();
            if($user_info->role_id==3)
            {
                $data = $this->validate($request, [
                    'company_id'   => 'required',
                    'fname'        => 'required',
                    'lname'        => '',
                    'email'        => 'required',
                    'password'        => 'required',
                    'postcode'        => 'required',
                    'address1'        => 'required',
                    'address2'        => '',
                    'state_id'       => 'required',
                    'city_id'       => 'required',
                ]);  
            }else{
                $data = $this->validate($request, [
                    'company_id'   => '',
                    'fname'        => 'required',
                    'lname'        => '',
                    'email'        => 'required',
                    'password'        => 'required',
                    'postcode'        => 'required',
                    'address1'        => 'required',
                    'address2'        => '',
                    'state_id'       => 'required',
                    'city_id'       => 'required',
                ]);  
            }
           
                      
            
            $user_info=Auth::user();
            if($user_info->role_id==3)
            {
                $data['company_id']=$data['company_id'];
            }else{
                $data['company_id']=$user_info->company_id;
            }
            $data['fname']=$data['fname'];
            $data['lname']=$data['lname'];
            $data['email']=$data['email'];
            $data['password'] = Hash::make($data['password']);
            $data['role_id'] = 1;

            $user = User::create($data);         
            
            $data1['user_id']=$user->id;
            $data1['address1']=$data['address1'];
            $data1['address2']=$data['address2'];
            $data1['state_id']=$data['state_id'];
            $data1['city_id']=$data['city_id'];
            $data1['postcode']=$data['postcode'];
            $data1['created_by']=$user_info->id;

            //dd($data1);
            $data1['badge']="test";

           $company = Driver::create($data1);
           return redirect('manage_driver')->withFlashSuccess('Driver added successfully');
            
        }
        $companyList  = Company::orderBy('company_name', 'ASC')->get();
        return view('admin.driver.create',compact('stateList','companyList'));      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update Driver
    public function update(Request $request,$id=null) {
        
        if(isset($id)){
            $editview = Driver::where('id', $id)->first(); 
            $usereditview = User::where('id', $editview->user_id)->first(); 
        }else{
            $editview = array();
            $usereditview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'company_id'   => 'required',
                'fname'        => 'required',
                'lname'        => '',
                'email'        => 'required',
                'password'        => 'required',
                'postcode'        => 'required',
                'address1'        => 'required',
                'address2'        => '',
                'state_id'       => 'required',
                'city_id'       => 'required',
                'id'           => '',
            ]);   

            $editview1 = Driver::where('id', $data['id'])->first(); 
            if(isset($data['id'])){

                $data['company_id']=$data['company_id'];
            $data['fname']=$data['fname'];
            $data['lname']=$data['lname'];
            $data['email']=$data['email'];
            $data['password'] = Hash::make($data['password']);

            $user = User::find($editview1->user_id);         
            $user->update($data);

            $data1['user_id']=$user->id;
            $data1['address1']=$data['address1'];
            $data1['address2']=$data['address2'];
            $data1['state_id']=$data['state_id'];
            $data1['city_id']=$data['city_id'];
            $data1['postcode']=$data['postcode'];

            $data1['badge']="test";
            $driver = Driver::find($data['id']);         
            $driver->update($data1);

                //$user = Driver::find($data['id']);
                //$user->update($data);
                return redirect('manage_driver')->withFlashSuccess('Driver updated successfully');
            } 
        }
        //print_r($userRole); die;
        $CityList    = City::orderBy('city_name', 'ASC')->get(); 
        $stateList    = State::orderBy('state_name', 'ASC')->get();  
        $companyList  = Company::orderBy('company_name', 'ASC')->get();
        return view('admin.driver.edit',compact('editview','companyList','stateList','usereditview','CityList'));      
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}