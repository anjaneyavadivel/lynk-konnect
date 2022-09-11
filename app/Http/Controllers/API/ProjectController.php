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
use DateTime;
use App\Models\Stops;
use App\Models\LiveTracking;
use Illuminate\Support\Facades\Validator;
//use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index()
    {
        $user = User::select('role_id')->where('id','=',Auth::id())->first();
        if($user->role_id==2)
        {
            $user_info=auth()->guard('api')->user();
            $tirp=Trip::where('is_active','=',1)->count();
            $driver=Driver::where('created_by','=',$user_info->id)->where('is_active','=',1)->count();
            $transaction = Transaction::where('operator_id','=',$user_info->company_id)->count();
            return response()->json(['success' => 1,'message'=>"",'data' => ['total_trip' => $tirp, 'total_driver' => $driver,'total_transaction'=> $transaction]], 200);
        }else{
            $user_info=auth()->guard('api')->user();
            $tirp=Trip::where('trip_owner_user_id','=',$user_info->id)->where('is_active','=',1)->count();
            return response()->json(['success' => 1,'message'=>"",'data' => ['total_trip' => $tirp]], 200);
        }
        
    }

    public function driver_list()
    {
        $user = User::select('role_id')->where('id','=',Auth::id())->first();
        if($user->role_id!=2)
        {
            return response()->json(['data' => data,'message' => 'This User does not exist, check your details','success' => 0], 400);
        }
        $user_info=auth()->guard('api')->user();
        $drivers=Driver::select('driver.*','users.email','company.company_name','users.fname','users.lname','state.state_name as state_name','city.city_name as city_name')
        ->join('users','driver.user_id','=','users.id')
        ->join('company','users.company_id','=','company.id')
        ->join('state','driver.state_id','=','state.id')
        ->join('city','driver.city_id','=','city.id')
        ->where('driver.created_by','=',$user_info->id)
        ->where('driver.is_active','=',1)->orderBy('id','Desc')->paginate(20);
        return response()->json(['success' => 1,'message'=>"",'data' => ['driver_list' => $drivers]], 200);
    }

    public function trip_list()
    {
        $user_info=auth()->guard('api')->user();
        $trips=Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name,cb.fname as takenby'))
        ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
        ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
        ->leftjoin('state AS s','s.id', 'trip.from_state_id')
        ->leftjoin('state AS st','st.id', 'trip.to_state_id')
        ->leftjoin('city AS c','c.id', 'trip.from_city_id')
        ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
        ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
        ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
        ->leftjoin('users AS cb','cb.id', 'trip.trip_takenby')
        ->where('trip.is_active','=',1)
        ->where('trip.completed_on','=',null)
        ->orWhere('trip.trip_date','>=',date('Y-m-d'))->paginate(20);
        return response()->json(['success' => 1,'message'=>"",'data' => ['trip_list' => $trips]], 200);
    }

    public function transaction_list()
    {
        $user = User::select('role_id')->where('id','=',Auth::id())->first();
        if($user->role_id!=2)
        {
            return response()->json(['data' => [],'message' => 'This User does not exist, check your details','success' => 0], 400);
        }
        $user_info=auth()->guard('api')->user();
        $list = Transaction::where('operator_id','=',$user_info->company_id)->orderBy('id','DESC')->paginate(20);
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
        $user = User::select('role_id')->where('id','=',Auth::id())->first();
        if($user->role_id!=2)
        {
            return response()->json(['data' => [],'message' => 'This User does not exist, check your details','success' => 0], 400);
        }
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
            'contactnumber' => 'required',
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
            $data1['contactnumber']=$data['contactnumber'];
            $data1['created_by']=$user_info->id;
            $data1['badge']="test";
            $company = Driver::create($data1);           
            return response()->json(['data' => [],'message' => 'Driver added successfully', 'success' => 1], 200);

        }catch (Exception $e) {
            return response()->json(['data' => [],'message' => 'Something Went Wrong', 'success' => 0],500);
        }
    }

    public function getCity(Request $request)
    {
       $city_list=City::select('id', 'city_name')->where('state_id', $request->state_id)->get(); 
       return response()->json(['data' => ['city_list' => $city_list],'success' => 1,'message' => ''], 200);
    }

    public function update_driver(Request $request)
    {
        $user = User::select('role_id')->where('id','=',Auth::id())->first();
        if($user->role_id!=2)
        {
            return response()->json(['data' => [],'message' => 'This User does not exist, check your details','success' => 0], 400);
        }
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
            'contactnumber' => 'required',
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
            $driver->contactnumber=$data['contactnumber'];
            $driver->save();         
            return response()->json(['data' => [],'message' => 'Driver updated successfully', 'success' => 1], 200);
        }catch (Exception $e) {
            return response()->json(['data' => [],'message' => 'Something Went Wrong', 'success' => 0],500);
        }
    }

    public function delete_driver(Request $request)
    {
        $user = User::select('role_id')->where('id','=',Auth::id())->first();
        if($user->role_id!=2)
        {
            return response()->json(['data' => [],'message' => 'This User does not exist, check your details','success' => 0], 400);
        }
        $data = $this->validate($request, [
            'id'=> 'required',
            'is_active'=> 'required',
        ]);
        $driver = Driver::where('id','=',$request->id)->first();
        if($driver)
        {
            $driver->is_active=$request->is_active;
            $driver->save();
            return response()->json(['data' => [],'message' => 'Driver deleted successfully', 'success' => 1], 200);
        }else{
            return response()->json(['data' => [],'message' => 'Something Went Wrong', 'success' => 0],500);
        }
    }

    public function create_trip(Request $request)
    {        
        $data = $this->validate($request, [
            'from_address'            => 'required',
            'from_state_id'           => 'required',
            'from_city_id'            => 'required', 
            'from_postcode'           => 'required',
            'to_address'              => 'required',
            'to_state_id'             => 'required',
            'to_city_id'              => 'required', 
            'to_postcode'             => 'required',
            'description_trip'        => '',
            'no_of_passengers'        => 'required',
            'trip_amount'             => 'required',
            'trip_date'               => 'required', 
            'trip_time'               => 'required',
            'from_latitude'           => 'required',
            'from_longitude' => 'required',
            'to_latitude' => 'required',
            'to_longitude' => 'required',
        ]);
        try{ 

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
            $source   = $data['trip_date'];
            $date     = new DateTime($source);
            $tripdate = $date->format('Y-m-d');           
                
            $data['trip_date'] = $tripdate;
            $triptime = date("H:i:s", strtotime($data['trip_time']));
            $data['trip_time'] = $triptime;

           $trip = Trip::create($data);

           return response()->json(['data' => [],'message' => 'Trip added successfully', 'success' => 1], 200);
        }catch (Exception $e) {
            return response()->json(['data' => [],'message' => 'Something Went Wrong', 'success' => 0],500);
        }
    }

    //---update trip
    public function update_trip(Request $request) {
        $data = $this->validate($request, [
            'from_address'            => 'required',
            'from_state_id'           => 'required',
            'from_city_id'            => 'required', 
            'from_postcode'           => 'required',
            'to_address'              => 'required',
            'to_state_id'             => 'required',
            'to_city_id'              => 'required', 
            'to_postcode'             => 'required',
            'description_trip'        => '',
            'no_of_passengers'        => 'required',
            'trip_amount'             => 'required',
            'trip_date'               => 'required', 
            'trip_time'               => 'required',
            'id' => 'required',
            'from_latitude'           => 'required',
            'from_longitude' => 'required',
            'to_latitude' => 'required',
            'to_longitude' => 'required', 
        ]);
        try{
            $source   = $data['trip_date'];
            $date     = new DateTime($source);
            $tripdate = $date->format('Y-m-d'); 
            $data['trip_date'] = $tripdate;

            $triptime = date("H:i:s", strtotime($data['trip_time']));
            $data['trip_time'] = $triptime;
            
            if(isset($data['id'])){
                $user = Trip::find($data['id']);
                $user->update($data);
                return response()->json(['data' => [],'message' => 'Trip updated successfully', 'success' => 1], 200);
            }
        }catch (Exception $e) {
            return response()->json(['data' => [],'message' => 'Something Went Wrong', 'success' => 0],500);
        }
    }

    public function delete_trip(Request $request)
    {
        $data = $this->validate($request, [
            'id'=> 'required',
            'is_active'=> 'required',
        ]);
        $trip = Trip::where('id','=',$request->id)->first();
        if($trip)
        {
            $trip->is_active=$request->is_active;
            $trip->save();
            return response()->json(['data' => [],'message' => 'Trip deleted successfully', 'success' => 1], 200);
        }else{
            return response()->json(['data' => [],'message' => 'Something Went Wrong', 'success' => 0],500);
        }
    }

    public function manageown_trip()
    {
        $query = Trip::select(\DB::raw('*,trip.id as id, trip.route_id as r_id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name'))
                ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
                ->where('trip.trip_owner_user_id', Auth::id())->where('trip.is_active','=',1)->paginate(20);
        return response()->json(['success' => 1,'message'=>"",'data' => ['manage_trip' => $query]], 200);
    }

    public function change_trip_status(Request $request)
    {
        $data = $this->validate($request, [
            'id'=> 'required',
            'trip_status'=> 'required',
        ]);
        $trip = Trip::where('id','=',$request->id)->first();
        if($trip)
        {
            $trip->trip_status=$request->trip_status;
            $trip->completed_on=date('Y-m-d H:i:s');
            $trip->save();

            if($trip_status==2)
            {
                $transaction=new Transaction;
                $transaction->uniq_id=mt_rand(10000000,99999999);
                $transaction->trip_id=$id;
                $transaction->operator_id=$trip->trip_owner_company_id;
                $transaction->status=1;
                $transaction->save();
            }

            return response()->json(['data' => [],'message' => 'Trip status changed successfully', 'success' => 1], 200);
        }else{
            return response()->json(['data' => [],'message' => 'Something Went Wrong', 'success' => 0],500);
        }
    }

    public function update_profile(Request $request)
    {
        $data = $this->validate($request, [
            'fname'=> 'required',
            'email'=> 'required',
        ]);

        $user_id = Auth::user()->id;
        $user_info = User::where('id', $user_id)->first(); 
        $user_info->fname=$request->fname;
        $user_info->lname=$request->lname;
        $user_info->email=$request->email;
        if($request->password)
        {
            $user_info->password=Hash::make($request->password);
        }
        $user_info->save();
        return response()->json(['data' => [],'message' => 'Profile Updated successfully', 'success' => 1], 200);
    }    

    public function return_trip_list(Request $request)
    {
        $distance=10;
        $trip_id='';
        $data=1; $output=''; $suggestion_trip=[];
        //if($request->trip_id!=0){

            $distance=$request->distance??10;
            $trip_id=$request->trip_id;
            $data=2;

            $from=Trip::FormLocation($distance,$trip_id);            
            if($from)
            {
                $from =$from->toArray();
                $result1 =array_column($from, 'id');
            }

            $to = Trip::ToLocation($distance,$trip_id);
            if($to)
            {
                $to =$to->toArray();
                $result2 =array_column($to, 'id');
            }

            $output = array_merge(array_diff($result1, $result2), array_diff($result2, $result1));
        //}

        $user_info=auth()->guard('api')->user();
        $trips=Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name'))
        ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
        ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
        ->leftjoin('state AS s','s.id', 'trip.from_state_id')
        ->leftjoin('state AS st','st.id', 'trip.to_state_id')
        ->leftjoin('city AS c','c.id', 'trip.from_city_id')
        ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
        ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
        ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id');        
        $trips=$trips->where(function ($query) use ($output) {
            if($output!='')
            {
                $query->where('trip.id', [$output]);
            }
            
        });
        $trips=$trips->paginate(20);

        $result2=[];
        $livetrip=LiveTracking::where('trip_id','=',$trip_id)->get(); 
        $trip = Trip::where('id','=',$trip_id)->first();   
        if($livetrip)
        {
            foreach($livetrip as $track)
            {
                
                
                $latitude=$track->latitude;
                $longitude=$track->longitude;
        
                $query = Trip::selectRaw("id , (1.609344 * 3956 * acos( cos( radians('$latitude') ) * cos( radians(to_latitude) ) * cos( radians(to_longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(to_latitude) ) ) ) AS distance, to_latitude, to_longitude")
                        ->having('distance', '<', $distance)
                        ->orderBy('distance')
                        ->get()->toArray();
                    
                    $result2[] =array_column($query, 'id');
            }

            $suggestion_trip=Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name'))
            ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
            ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
            ->leftjoin('state AS s','s.id', 'trip.from_state_id')
            ->leftjoin('state AS st','st.id', 'trip.to_state_id')
            ->leftjoin('city AS c','c.id', 'trip.from_city_id')
            ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
            ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
            ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
            ->where('trip.trip_status','=',1);        
            $suggestion_trip=$suggestion_trip->where(function ($query) use ($result2) {
                if($result2!='')
                {
                    $test=array_unique($result2);
                    $query->where('trip.id', [$test]);
                }
                
            });
            $suggestion_trip=$suggestion_trip->paginate(20);
        }
        return response()->json(['success' => 1,'message'=>"",'data' => ['return_trip_list' => $trips, 'suggestion_trips' => $suggestion_trip]], 200);
    }

    public function live_tracking(Request $request)
    {
        $data = $this->validate($request, [
            'trip_id'            => 'required',
            'latitude'           => 'required',
            'longitude'            => 'required',
        ]);

        $tracking=new LiveTracking;
        $tracking->trip_id=$request->trip_id;
        $tracking->latitude=$request->latitude;
        $tracking->longitude=$request->longitude;
        $tracking->save();
        return response()->json(['success' => 1,'message'=>"Tracking updated successfully",'data' => []], 200);
    }

    public function pay_trip(Request $request)
    {
        $id=$request->id;
        $pay_status=$request->pay_status;

        $pay = Transaction::find($id);
        if($pay)
        {
            $data['status']=$pay_status;
            $data['updated_at']=date('Y-m-d H:i:s');
            $pay->update($data);
            return response()->json(['success' => 1,'message'=>"Paid successfully",'data' => []], 200);
        }
        return response()->json(['data' => [],'message' => 'Something Went Wrong', 'success' => 0],500);  
    }
}