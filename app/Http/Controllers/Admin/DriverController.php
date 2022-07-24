<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Driver,State};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
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
            $data = $this->validate($request, [
                'company_name'   => 'required',
                'address'        => 'required',
                'landmark'       => '',
                'latitude'       => '',
                'longitutude'    => '', 
                'contact_person' => '',
                'contact_no1'    => '',
                'contact_no2'    => '',
            ]);

           $company = Company::create($data);
           return redirect('manage_company')->withFlashSuccess('Company added successfully');
            
        }
        return view('admin.driver.create',compact('stateList'));      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update Driver
    public function update(Request $request,$id=null) {
        
        if(isset($id)){
            $editview = Company::where('id', $id)->first(); 
        }else{
            $editview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'company_name'   => 'required',
                'address'        => 'required',
                'landmark'       => '',
                'latitude'       => '',
                'longitutude'    => '', 
                'contact_person' => '',
                'contact_no1'    => '',
                'contact_no2'    => '',
                'id'             => '',
            ]);

            
            if(isset($data['id'])){
                $user = Company::find($data['id']);
                $user->update($data);
                return redirect('manage_company')->withFlashSuccess('Company updated successfully');
            } 
        }
        //print_r($userRole); die;
        return view('admin.company.edit',compact('editview'));      
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}