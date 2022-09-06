<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User,Company,State,City,Driver,Trip,Routes,Stops,Transaction};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Session;
use DateTime;
use Illuminate\Support\Arr;
use App\Models\LiveTracking;
use Illuminate\Support\Facades\Auth;
use Response;

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
           // dd($request->all());
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
                'from_latitude'           => '', 
                'from_longitude'          => '',
                'to_latitude'             => '', 
                'to_longitude'            => '', 
                'map_from_address'         => '', 
                'map_to_address'            => '', 
                'trip_time'               => '', 

            ]);
            //echo $data['to_latitude'];exit;
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
          //  dd($request->all());
            
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
                'from_latitude'           => '', 
                'from_longitude'          => '',
                'to_latitude'             => '', 
                'to_longitude'            => '', 
                'map_from_address'         => '', 
                'map_to_address'            => '', 
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
            $data['completed_on']=date('Y-m-d H:i:s');
            $trip->update($data);

            if($trip_status==2)
            {
                $transaction=new Transaction;
                $transaction->uniq_id=mt_rand(10000000,99999999);
                $transaction->trip_id=$id;
                $transaction->operator_id=$trip->trip_owner_company_id;
                $transaction->status=1;
                $transaction->save();
            }
            return redirect()->back();
        }
        return redirect()->with('error','Error');      
                
    }

    public function download()
    {
        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=Lynk-Konnect.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );
    
        $filename = "Lynk-Konnect.csv";
        $handle = fopen($filename, 'w');
        fputcsv($handle, [
            "S No",
            "Trip Taken By",
            "Trip From Address",
            "Trip To Address",
            "Posted by",
            "Passengers",
            "Trip Amount",
        ]);
        
        Trip::select('trip.id','trip.trip_date','trip.to_address','trip.from_address','trip.no_of_passengers','trip.trip_amount','u.fname as owner_fname','s.state_name as f_state_name', 'st.state_name as t_state_name')
        ->join('users AS u','u.id', 'trip.trip_owner_user_id')
        ->join('state AS s','s.id', 'trip.from_state_id')
        ->join('state AS st','st.id', 'trip.to_state_id')
        ->chunk(100, function ($data) use ($handle) {
            $i=1;
            foreach ($data as $row) {
                // Add a new row with data
                fputcsv($handle, [
                    $i,
                    date('d-m-Y',strtotime($row->trip_date)),
                    $row->from_address.' '.$row->f_state_name,
                    $row->to_address.' '.$row->t_state_name,
                    $row->owner_fname,
                    $row->no_of_passengers,
                    $row->trip_amount
                ]);
                $i++;
            }
        });
        
        fclose($handle);
        
        return Response::download($filename, "Lynk-Konnect.csv", $headers);
    }

    public function return_trip(Request $request,$id)
    {
        $distence=10;
        $trip_id=$id;
        $data=1; $output=[]; $suggestion_trip=[]; $output1=[];
        //if($request->has('_token')){

            $distence=$request->distence??10;
            $trip_id=$id;
            $data=2;

            $from=Trip::FormLocation($distence,$trip_id);            
            if($from)
            {
                $from =$from->toArray();
                $result1 =array_column($from, 'id');
            }

            $to = Trip::ToLocation($distence,$trip_id);
            if($to)
            {
                $to =$to->toArray();
                $result2 =array_column($to, 'id');
            }

            $output = array_merge(array_diff($result1, $result2), array_diff($result2, $result1));
        //}

        $list = Trip::getreturnTrip($data,$output);

        $livetrip=LiveTracking::where('trip_id','=',$trip_id)->orderBy('id','DESC')->first();
        if($livetrip)
        {
            $to = Trip::ToLocation($distance,$trip_id);
            if($to)
            {
                $to =$to->toArray();
                $result2 =array_column($to, 'id');
            }

            $latitude=$livetrip->latitude;
            $longitude=$livetrip->longitude;

            $to = Trip::LiveToLocation($distance,$longitude,$latitude);
            if($to)
            {
                $to =$to->toArray();
                $result2 =array_column($to, 'id');
            }            

            $output1 = array_merge(array_diff($result1, $result2), array_diff($result2, $result1));

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
            $suggestion_trip=$suggestion_trip->where(function ($query) use ($output) {
                if($output1!='')
                {
                    $query->where('trip.id', [$output1]);
                }
                
            });
            $suggestion_trip=$suggestion_trip->paginate(20);
        }

        return view('admin.trip.index_return', compact('list','id','distence','suggestion_trip'));  
    }

}