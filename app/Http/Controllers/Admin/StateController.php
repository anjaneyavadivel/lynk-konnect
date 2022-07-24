<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Country,State};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class StateController extends Controller
{

    function __construct(){
         $this->middleware('permission:state-list|state-create|state-edit|state-delete', ['only' => ['index','show']]);
         $this->middleware('permission:state-create', ['only' => ['create','store']]);
         $this->middleware('permission:state-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:state-delete', ['only' => ['destroy']]);
    }


    // -- Manage State
    public function index() { 

        //$list = State::orderBy('id','DESC')->get();
        $list = State::getState();
        return view('admin.state.index',compact('list'));
    }

    //---Create State
    public function create(Request $request) { 
       $countryList  = Country::orderBy('country_name', 'ASC')->get();  
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'country_id'   => 'required',
                'state_name'   => 'required',
            ]);

           $state = State::create($data);
           return redirect('manage_state')->withFlashSuccess('State added successfully');
            
        }
        return view('admin.state.create',compact('countryList'));      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update User
    public function update(Request $request,$id=null) {
       $countryList  = Country::orderBy('country_name', 'ASC')->get();   
        if(isset($id)){
            $editview = State::where('id', $id)->first(); 
        }else{
            $editview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'country_id'   => 'required',
                'state_name'   => 'required',
            ]);

            
            if(isset($data['id'])){
                $state = State::find($data['id']);
                $state->update($data);
                return redirect('manage_state')->withFlashSuccess('State updated successfully');
            } 
        }
        return view('admin.state.edit',compact('editview','countryList'));      
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}