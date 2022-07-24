<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Country,State,City,Routes};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class RouteController extends Controller
{

    function __construct(){
         $this->middleware('permission:route-list|route-create|route-edit|route-delete', ['only' => ['index','show']]);
         $this->middleware('permission:route-create', ['only' => ['create','store']]);
         $this->middleware('permission:route-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:route-delete', ['only' => ['destroy']]);
    }
    // -- Manage Route
    public function index() {
        //$list = State::orderBy('id','DESC')->get();
        $list = Routes::getRoutes();
        return view('admin.routes.index',compact('list'));
    }

    //---Create Route
    public function create(Request $request) { 
       $stateList  = State::orderBy('state_name', 'ASC')->get();  
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'route_name'           => 'required',
                'from_route_state_id'  => 'required',
                //'from_route_city_id'   => 'required',
                'to_route_state_id'    => 'required',  
                //'to_route_city_id'     => 'required',
                'description'          => '',
            ]);

           $route = Routes::create($data);
           return redirect('manage_route')->withFlashSuccess('Route added successfully');
            
        }
        return view('admin.routes.create',compact('stateList'));      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update Route
    public function update(Request $request,$id=null) {
       $stateList  = State::orderBy('state_name', 'ASC')->get();     
        if(isset($id)){
            $editview = Routes::where('id', $id)->first(); 
           
            //echo $editview->from_route_state_id; die;
            $from_cityview = City::where('state_id', $editview->from_route_state_id)->get();
            $to_cityview = City::where('state_id', $editview->to_route_state_id)->get();
           

        }else{
            $editview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'route_name'           => 'required',
                'from_route_state_id'  => 'required',
                //'from_route_city_id'   => 'required',
                'to_route_state_id'    => 'required',  
                //'to_route_city_id'     => 'required',
                'description'          => '',
                'id'                   => '',
            ]);

            
            if(isset($data['id'])){
                $route = Routes::find($data['id']);
                $route->update($data);
                return redirect('manage_route')->withFlashSuccess('Route updated successfully');
            } 
        }
        return view('admin.routes.edit',compact('editview','stateList','from_cityview','to_cityview'));      
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}