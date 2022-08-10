<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Company,State,City,Driver,Trip,Routes,Stops};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Session;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{

    function __construct(){
         $this->middleware('permission:trip-list|trip-list-own|trip-create|trip-edit|trip-delete', ['only' => ['index','show']]);
         
         $this->middleware('permission:trip-list-own', ['only' => ['index_own']]);

         $this->middleware('permission:trip-create', ['only' => ['create','store']]);
         $this->middleware('permission:trip-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:trip-delete', ['only' => ['destroy']]);
    }

    // -- Manage Trip
    public function index($rid=null) { 
        
        //$list = Trip::orderBy('id','DESC')->get();
        $list = Trip::getTrip($rid);
        return view('admin.trip.index',compact('list'));
    }

    
    // -- Manage Own Trip
    public function index_own() { 
        
        $user_id = Auth::user()->id;
        $id      = User::where('id', $user_id)->first(); 
        // echo $id->company_id;
        // die;
        // Session::put('company_id_s', $id->company_id);

        //$comp_id = Session::get('company_id_s'); 
        $comp_id = $id->company_id;
        
        $list    = Trip::getOwnTrip($comp_id);
        
        if(isset($list)){
            $list    = Trip::getOwnTrip($comp_id);
        }else{
            $list    = array();
        }
        return view('admin.trip.index_own',compact('list'));
    }

    public static function getReturnRouteId($from_id,$to_id){
        // if (!Session::has('userID')){return redirect('/');}
        // $customerpay = new InvCustomerPay();
        // $TotalpaySub = $customerpay->TotalpaySub($cusid);
        // return $TotalpaySub;
      //  return Routes::select('idX')->where('from_route_state_id', $to_id)->where('to_route_state_id', $from_id)->get();

        return $editview = Routes::select('id')->where('from_route_state_id', $to_id)->where('to_route_state_id', $from_id)->get();  
        
        

    }
    
    public function getCity(Request $request)
    {
       return City::select('id', 'city_name')->where('state_id', $request->state_id)->get(); 
    }

    //---Create Trip
    public function create(Request $request) { 
        // $time = '04:25PM'; 
        // echo date("H:i:s", strtotime($time));
        // die; 
        // $fromStateId  = 130; 
        //     $toStateId    = 124;
        
            
        //     $routeId = Stops::getRouteId($fromStateId,$toStateId);
       
            
        //     echo $routeId['0']['routeId']; die;


    
    $companyList  = Company::orderBy('company_name', 'ASC')->get();
    $stateList    = State::orderBy('state_name', 'ASC')->get();
        if($request->has('_token')){   
            $data = $this->validate($request, [
                //'trip_owner_user_id'    => 'required',
                'trip_owner_company_id'   => '',
                'from_address'            => '',
                'from_state_id'           => '',
                'from_city_id'            => '', 
                'from_postcode'           => '',
                'to_address'              => '',
                'to_state_id'             => '',
                'to_city_id'              => '', 
                'to_postcode'             => '',
                'description_trip'        => '',
                'no_of_passengers'        => '',
                'trip_amount'             => '',
                'trip_confirm_user_id'    => '',
                'trip_confirm_company_id' => '',
                'trip_status'             => '',
                'route_id'                => '',
                'return_route_id'         => '', 
                'trip_date'               => '', 
                'trip_time'               => '', 

            ]);

           $data['trip_owner_user_id'] = Auth::id();

           $data['trip_status'] = 1;

        //$user_id = Auth::user()->id;
        $id      = User::where('id', $data['trip_owner_user_id'])->first(); 
        $data['trip_owner_company_id'] = $id->company_id;
           
           #---- dev  ----
            $fromStateId  = $data['from_state_id']; 
            $toStateId    = $data['to_state_id'];
        
            
            $routeId = Stops::getRouteId($fromStateId,$toStateId);
            if(isset($routeId['0']['routeId'])){
                $data['route_id'] = $routeId['0']['routeId'];
            }else{
                $data['route_id'] =  0;
            }

            $returnRouteId = Stops::getReturnRouteId($fromStateId,$toStateId);
            if(isset($returnRouteId['0']['routeId'])){
                $data['return_route_id'] = $returnRouteId['0']['routeId'];
            }else{
                $data['return_route_id'] =  0;
            }

            // $source = '15-12-2021';  //dd/mm/yyyy
            $source   = $data['trip_date'];
            $date     = new DateTime($source);
            $tripdate = $date->format('Y-m-d');
            
                
            $data['trip_date'] = $tripdate;

            //18:43:00
            // $time = '04:25PM';
            $triptime = date("H:i:s", strtotime($data['trip_time']));
            $data['trip_time'] = $triptime;

           #---- End of dev  ----

           $trip = Trip::create($data);

           return redirect('manage_trip')->withFlashSuccess('Trip added successfully');
            
        }
        return view('admin.trip.create', compact('companyList','stateList'));      
    }
    

    public function show($id){
      $companyList  = Company::orderBy('company_name', 'ASC')->get();
      $stateList    = State::orderBy('state_name', 'ASC')->get(); 

        $list = Trip::find($id);
        //$list = Trip::getTrip($id);
        return view('admin.trip.show',compact('list','companyList','stateList'));
    }
    

    //---update Driver
    public function update(Request $request,$id=null) {
        
        if(isset($id)){
            //$editview = Company::where('id', $id)->first(); 
            $editview = Trip::where('id', $id)->first(); 
        }else{
            $editview = array();
        }
        
        if($request->has('_token')){  
                
            
           $data = $this->validate($request, [
                //'trip_owner_user_id'    => 'required',
                'trip_owner_company_id'   => '',
                'from_address'            => '',
                'from_state_id'           => '',
                'from_city_id'            => '', 
                'from_postcode'           => '',
                'to_address'              => '',
                'to_state_id'             => '',
                'to_city_id'              => '', 
                'to_postcode'             => '',
                'description_trip'        => '',
                'no_of_passengers'        => '',
                'trip_amount'             => '',
                'trip_confirm_user_id'    => '',
                'trip_confirm_company_id' => '',
                'trip_status'             => '',
                'route_id'                => '',
                'return_route_id'         => '', 
                'trip_date'               => '', 
                'trip_time'               => '', 
                'id' => '', 

            ]);
            $source   = $data['trip_date'];
            $date     = new DateTime($source);
            $tripdate = $date->format('Y-m-d'); 
            $data['trip_date'] = $tripdate;

            $triptime = date("H:i:s", strtotime($data['trip_time']));
            $data['trip_time'] = $triptime;
            
            if(isset($data['id'])){
                $user = Trip::find($data['id']);
                $user->update($data);
                return redirect('manage_trip')->withFlashSuccess('Trip updated successfully');
            } 
        }
        
        $companyList  = Company::orderBy('company_name', 'ASC')->get();
        $stateList    = State::orderBy('state_name', 'ASC')->get();
        $citylist    =City::select('id', 'city_name')->get();
        //return view('admin.company.edit',compact('editview','stateList'));      
        return view('admin.trip.edit', compact('companyList','stateList','editview','citylist'));   
    }


    
    public function destroy($id){
        User::find($id)->delete();
        return redirect()->route('users.index')->with('success','User deleted successfully');

    }

    public function status_change(Request $request)
    {
        $id=$request->id;
        $trip_status=$request->trip_status;

        $trip = Trip::find($id);
        if($trip)
        {
            $data['trip_status']=$trip_status;
            $trip->update($data);
            return redirect()->back();
        }
        return redirect()->with('error','Error');      
                
    }

}