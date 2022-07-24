<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Country,State,City,Routes,Stops};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class StopController extends Controller
{

    function __construct(){
         $this->middleware('permission:stop-list|stop-create|stop-edit|stop-delete', ['only' => ['index','show']]);
         $this->middleware('permission:stop-create', ['only' => ['create','store']]);
         $this->middleware('permission:stop-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:stop-delete', ['only' => ['destroy']]);
    }
    // -- Manage Stop
    public function index($id) { 
        $routeList  = Routes::orderBy('route_name', 'ASC')->get();
        if(isset($id)){
            $list = Stops::getStops($id);

            $route_id = $id;
        }else{
            $list = array();
        }
        
        return view('admin.stops.index',compact('list','routeList','route_id'));
    }

    //---Create Stop
    public function create(Request $request) { 
       $routeList  = Routes::orderBy('route_name', 'ASC')->get();
       $stateList  = State::orderBy('state_name', 'ASC')->get();

        if($request->has('_token')){   
            $data = $this->validate($request, [
                'route_id'            => '',
                'from_route_state_id' => '',
                'stop_state_id'       => '',
                'stop_city_id'        => '',
                'position'            => '',
                'description'         => '',

            ]);
           //print_r($data); die;
           Stops::createStops($data);

          // $route = Routes::create($data);
          // return redirect('manage_stop')->withFlashSuccess('Stops added successfully');
           return \Redirect::route('manage_stop', ['id' => $data['route_id']])->withFlashSuccess('Stops updated successfully!');
        }
        return view('admin.stops.create',compact('routeList','stateList'));      
    }
    

    public function show($id){
        $user = User::find($id);
        return view('admin.users.show',compact('user'));
    }
    

    //---update Stop
    public function update(Request $request,$id=null) {
       $routeList  = Routes::orderBy('route_name', 'ASC')->get();
       $stateList  = State::orderBy('state_name', 'ASC')->get();

        if(isset($id)){
            //$editview = Stops::where('id', $id)->first(); 
            $editview = Stops::where('route_id', $id)->get();
            $route_id = $id;
        }else{
            $editview = array();
        }
        
        if($request->has('_token')){   
            $data = $this->validate($request, [
                'route_id'            => 'required',
                'stop_state_id'       => 'required',
                'stop_city_id'        => 'required',
                'position'            => 'required',
                'description'         => '',
                'id'                  => '',
            ]);

            
            if(isset($data['route_id'])){
                // $route = Routes::find($data['id']);
                // $route->update($data);
                DB::table('stops')->where('route_id', '=', $data['route_id'])->delete();

                Stops::createStops($data);
                //return redirect('manage_stop')->withFlashSuccess('Stops updated successfully');

                return \Redirect::route('manage_stop', ['id' => $data['route_id']])->withFlashSuccess('Stops updated successfully!');


            } 
        }
        return view('admin.stops.edit',compact('editview','route_id','routeList','stateList'));      
    }

    public static function getCityE($state_id){
        return City::select('*')->where('state_id', $state_id)->get();  
    }

    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

}