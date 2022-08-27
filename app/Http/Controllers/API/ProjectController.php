<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Driver;
use App\Models\Transaction;
use App\Models\State;
use App\Models\Company;
use App\Models\User;
use App\Models\City;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Facades\Validator;
//use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index()
    {
        $user_info=auth()->guard('api')->user();
        $tirp=Trip::where('trip_owner_user_id','=',$user_info->id)->count();
        $driver=Driver::where('created_by','=',$user_info->id)->count();
        $transaction = Transaction::where('operator_id','=',$user_info->id)->count();
        return response()->json(['success' => 1,'message'=>"",'data' => ['total_trip' => $tirp, 'total_driver' => $driver,'total_transaction'=> $transaction]], 200);
    }

    public function driver_list()
    {
        $user_info=auth()->guard('api')->user();
        $drivers=Driver::select('driver.*','users.email','company.company_name','users.fname','users.lname','state.state_name as state_name','city.city_name as city_name')
        ->join('users','driver.user_id','=','users.id')
        ->join('company','users.company_id','=','company.id')
        ->join('state','driver.state_id','=','state.id')
        ->join('city','driver.city_id','=','city.id')
        ->where('driver.user_id','=',$user_info->id)
        ->where('driver.is_active','=',1)->orderBy('id','Desc')->paginate(20);
        return response()->json(['success' => 1,'message'=>"",'data' => ['driver_list' => $drivers]], 200);
    }

    public function trip_list()
    {
        $user_info=auth()->guard('api')->user();
        $trips=Trip::select('trip.*','company.company_name','sta.state_name as to_state_name','cit.city_name as to_city_name','state.state_name as from_state_name','city.city_name as from_city_name')
        ->join('company','trip.trip_owner_company_id','=','company.id')
        ->leftJoin('state','trip.from_state_id','=','state.id')
        ->leftJoin('city','trip.from_city_id','=','city.id')
        ->leftJoin('state as sta','trip.to_state_id','=','sta.id')
        ->leftJoin('city as cit','trip.to_city_id','=','cit.id')
        ->where('trip.trip_owner_user_id','=',$user_info->id)->orderBy('id','Desc')->paginate(20);
        return response()->json(['success' => 1,'message'=>"",'data' => ['trip_list' => $trips]], 200);
    }

    public function transaction_list()
    {
        $user_info=auth()->guard('api')->user();
        $list = Transaction::where('operator_id','=',$user_info->id)->orderBy('id','DESC')->paginate(20);
        return response()->json(['success' => 1,'message'=>"",'data' => ['transaction_list' => $list]], 200);
    }

    public function common_list()
    {
        $stateList = State::orderBy('state_name', 'ASC')->get();
        $companyList  = Company::orderBy('company_name', 'ASC')->get();
        return response()->json(['success' => 1,'message'=>"",'data' => ['state_list' => $stateList,'company_list' => $companyList]], 200);
    }
    
    public function create_driver(Request $request)
    {
        $user_info=auth()->guard('api')->user();
        $data = $this->validate($request, [
            'fname'=> 'required',
            'lname'=> '',
            'email'=> 'required',
            'password'=> 'required',
            'postcode'=> 'required',
            'address1'=> 'required',
            'address2'=> '',
            'state_id'=> 'required',
            'city_id'=> 'required',
        ]); 

        try{
           
            $data['company_id']=$user_info->company_id;
            $data['fname']=$data['fname'];
            $data['lname']=$data['lname'];
            $data['email']=$data['email'];
            $data['password'] = Hash::make($data['password']);
            $data['role_id'] = 1;
            $user = User::create($data);
            $user->assignRole(1);        
            
            $data1['user_id']=$user->id;
            $data1['address1']=$data['address1'];
            $data1['address2']=$data['address2'];
            $data1['state_id']=$data['state_id'];
            $data1['city_id']=$data['city_id'];
            $data1['postcode']=$data['postcode'];
            $data1['created_by']=$user_info->id;
            $data1['badge']="test";
            $company = Driver::create($data1);           
            return response()->json(['data' => '','message' => 'Driver added successfully', 'success' => 1], 200);

        }catch (Exception $e) {
            return response()->json(['data' => '','message' => 'Something Went Wrong', 'success' => 0],500);
        }
    }

    public function getCity(Request $request)
    {
       $city_list=City::select('id', 'city_name')->where('state_id', $request->state_id)->get(); 
       return response()->json(['data' => ['city_list' => $city_list],'success' => 1,'message' => ''], 200);
    }

    public function update_driver(Request $request)
    {
        $user_info=auth()->guard('api')->user();
        $data = $this->validate($request, [
            'id'=> 'required',
            'fname'=> 'required',
            'lname'=> '',
            'email'=> 'required',
            'password'=> '',
            'postcode'=> 'required',
            'address1'=> 'required',
            'address2'=> '',
            'state_id'=> 'required',
            'city_id'=> 'required',
        ]);
        try{  

        $driver = Driver::where('id','=',$request->id)->first();
        $user = User::where('id','=',$driver->user_id)->first();
        $user->fname=$data['fname'];
        $user->lname=$data['lname'];
        $user->email=$data['email'];
        if($data['password'])
        {
            $user->password= Hash::make($data['password']);
        }
        $user->save();
        
        $driver->address1=$data['address1'];
        $driver->address2=$data['address2'];
        $driver->state_id=$data['state_id'];
        $driver->city_id=$data['city_id'];
        $driver->postcode=$data['postcode'];
        $driver->save();         
        return response()->json(['data' => '','message' => 'Driver updated successfully', 'success' => 1], 200);
    }catch (Exception $e) {
        return response()->json(['data' => '','message' => 'Something Went Wrong', 'success' => 0],500);
     }
    }

    public function delete_driver(Request $request)
    {
        $data = $this->validate($request, [
            'id'=> 'required',
            'is_active'=> 'required',
        ]);
        $driver = Driver::where('id','=',$request->id)->first();
        if($driver)
        {
            $driver->is_active=$request->is_active;
            $driver->save();
            return response()->json(['data' => '','message' => 'Driver deleted successfully', 'success' => 1], 200);
        }else{
            return response()->json(['data' => '','message' => 'Something Went Wrong', 'success' => 0],500);
        }
    }

    public function create_trip(Request $request)
    {
        
            $data = $this->validate($request, [               
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
        
            $id= User::where('id', $data['trip_owner_user_id'])->first(); 
            $data['trip_owner_company_id'] = $id->company_id;  
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
}