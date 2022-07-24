<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Country};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class CountryController extends Controller
{

    // -- Manage Country
    public function index() { 

        $list = Country::orderBy('id','DESC')->get();
        //$list = Company::getCompany();
        return view('admin.country.index',compact('list'));
    }

    //---Create User
    public function create(Request $request) { 
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'country_name'   => 'required',
                'decription'     => '',
                
            ]);

           $country= Country::create($data);
           return redirect('manage_country')->withFlashSuccess('Counrty added successfully');
            
        }
        return view('admin.country.create');      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update User
    public function update(Request $request,$id=null) {
        
        if(isset($id)){
            $editview = Country::where('id', $id)->first(); 
        }else{
            $editview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'country_name'   => 'required',
                'decription'     => '',
                'id'             => '',
            ]);

            
            if(isset($data['id'])){
                $country = Country::find($data['id']);
                $country->update($data);
                return redirect('manage_country')->withFlashSuccess('Country updated successfully');
            } 
        }
        return view('admin.country.edit',compact('editview'));      
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}