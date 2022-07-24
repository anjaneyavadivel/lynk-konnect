<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Country,State,City};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class CityController extends Controller
{

    function __construct(){
         $this->middleware('permission:city-list|city-create|city-edit|city-delete', ['only' => ['index','show']]);
         $this->middleware('permission:city-create', ['only' => ['create','store']]);
         $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }

    // -- Manage City
    public function index() { 

        //$list = State::orderBy('id','DESC')->get();
        $list = City::getCity();
        return view('admin.city.index',compact('list'));
    }

    //---Create State
    public function create(Request $request) { 
       $countryList  = Country::orderBy('country_name', 'ASC')->get();  
       $stateList    = State::orderBy('state_name', 'ASC')->get();  
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'country_id'   => 'required',
                'state_id'     => 'required', 
                'city_name'    => 'required',
                'description'  => '',
            ]);

           $city = City::create($data);
           return redirect('manage_city')->withFlashSuccess('Neighborhoods added successfully');
            
        }
        return view('admin.city.create',compact('countryList','stateList'));      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update User
    public function update(Request $request,$id=null) {
        $stateList    = State::orderBy('state_name', 'ASC')->get();  
        if(isset($id)){
            $editview = City::where('id', $id)->first(); 
        }else{
            $editview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'country_id'   => 'required',
                'state_id'     => 'required', 
                'city_name'    => 'required',
                'description'  => '',
                'id'             => '',
            ]);

            
            if(isset($data['id'])){
                $city = City::find($data['id']);
                $city->update($data);
                return redirect('manage_city')->withFlashSuccess('Neighborhoods updated successfully');
            } 
        }
        return view('admin.city.edit',compact('editview','stateList'));      
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}