<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Company,State,City};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class CompanyController extends Controller
{

    function __construct(){
         $this->middleware('permission:company-list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
         $this->middleware('permission:company-create', ['only' => ['create','store']]);
         $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }

    // -- Manage Compnay
    public function index() { 

        $list = Company::orderBy('id','DESC')->get();
        //$list = Company::getCompany();
        return view('admin.company.index',compact('list'));
    }

    //---Create Company
    public function create(Request $request) { 
      $stateList    = State::orderBy('state_name', 'ASC')->get();  
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'company_name'   => 'required',
                'address'        => 'required',
                'state_id'       => 'required',
                'city_id'        => 'required',
                'landmark'       => '',
                'postcode'       => 'required', 
                'latitude'       => '',
                'longitutude'    => '', 
                'contact_person' => '',
                'contact_no1'    => 'required',
                'contact_no2'    => 'required',              
                'website'        => 'required',
                'emailid'        => 'required',
                'licence' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',

            ]);
            if (request()->hasFile('licence')) {
               $imageName = time().'.'.request()->licence->getClientOriginalExtension();
               request()->licence->move(public_path('uploads'), $imageName);
               $data['licence']=$imageName;
            }
           $company = Company::create($data);
           return redirect('manage_company')->withFlashSuccess('Company added successfully');
            
        }
        return view('admin.company.create',compact('stateList'));      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update User
    public function update(Request $request,$id=null) {
        $stateList    = State::orderBy('state_name', 'ASC')->get();  
        if(isset($id)){
            $editview = Company::where('id', $id)->first();
            $cityList = City::orderBy('city_name', 'ASC')->get();
        }else{
            $editview = array();
            $cityList = array();
        }
        
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'company_name'   => 'required',
                'address'        => 'required',
                'state_id'       => 'required',
                'city_id'        => 'required',
                'landmark'       => '',
                'postcode'       => 'required', 
                'latitude'       => '',
                'longitutude'    => '', 
                'contact_person' => '',
                'contact_no1'    => 'required',
                'contact_no2'    => 'required',
                'licence' => 'mimes:jpeg,png,jpg,gif,svg,pdf|max:2048',
                'website'        => 'required',
                'emailid'        => 'required',
                'id'              => 'required',
            ]);

            if (request()->hasFile('licence')) {
                $imageName = time().'.'.request()->licence->getClientOriginalExtension();
                request()->licence->move(public_path('uploads'), $imageName);
                $data['licence']=$imageName;
             }
             else{
                $data['licence']=request()->licencehidden;
             }
            if(isset($data['id'])){
                $user = Company::find($data['id']);
                $user->update($data);
                return redirect('manage_company')->withFlashSuccess('Company updated successfully');
            } 
        }
        //print_r($userRole); die;
        return view('admin.company.edit',compact('editview','stateList','cityList'));      
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}