<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User};
use App\Models\Company;
use App\Models\Trip;
use App\Models\Driver;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Session;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct(){
         //$this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
       /*$this->middleware('permission:dashboard-admin', ['only' => ['dashboardAdmin']]);
         $this->middleware('permission:dashboard-operator', ['only' => ['dashboardOperator']]);
        $this->middleware('permission:dashboard-driver', ['only' => ['dashboardDriver']]);*/
         // $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboardAdmin(){
        
        $user_id = Auth::user()->id;
        $user_info=Auth::user()->role_id;
        $id      = User::where('id', $user_id)->first();
        $usercount=User::where('is_active','=',1)->count();
        $companycount=Company::count();
        Session::put('company_id_s', $id->company_id);
        if($user_info==3){
           $divercount=Driver::where('is_active','=',1)->count();
          // $tripcount=Trip::where('is_active','=',1)->count();
          $tripcount=  Trip::getTrip("")->count();
        }
        if($user_info==2){
            $divercount=User::where('is_active','=',1)->where('role_id','=',1)->where('company_id','=', $id->company_id)->count();
           // $tripcount=Trip::where('is_active','=',1)->count();
           $user_id = Auth::user()->id;
           $id      = User::where('id', $user_id)->first(); 
           $comp_id = $id->company_id;
           $tripcount    = Trip::getOwnTrip($comp_id)->count();
        }
        //print_r($id); die;
        return view('admin.dashboard.admin_dash',compact('usercount','companycount','divercount','tripcount'));
    }

    public function dashboardOperator()
    {      
        $user_id = Auth::user()->id;
        $id      = User::where('id', $user_id)->first(); 
        
        Session::put('company_id_s', $id->company_id);

        return view('admin.dashboard.admin_dash');
    }

    public function dashboardDriver()
    {
        
        $user_id = Auth::user()->id;
        $id      = User::where('id', $user_id)->first(); 
        
        Session::put('company_id_s', $id->company_id);

        return view('admin.dashboard.admin_dash');
    }
}
