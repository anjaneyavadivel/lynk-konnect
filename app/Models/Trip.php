<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Auth;

class Trip extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "trip";

    protected $fillable = [
        'trip_owner_user_id',
        'trip_owner_company_id',
        'from_address',
        'from_state_id',
        'from_city_id',
        'from_postcode',
        'to_address',
        'to_state_id',
        'to_city_id',
        'to_postcode',
        'description_trip',
        'no_of_passengers',
        'trip_amount',
        'trip_confirm_user_id',
        'trip_confirm_company_id',
        'trip_status',
        'route_id',
        'return_route_id',
        'trip_date',
        'trip_time',
        'from_latitude',
        'from_longitude',
        'to_latitude',
        'to_longitude',
        'map_from_address',
        'map_to_address',
        'is_active',
        'completed_on',
        'trip_takenby'
    ];

    public static function getTrip($rid=null){
        if($rid == null){
        $query = Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name,cb.fname as takenby'))
                    ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                    ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                    ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                    ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                    ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                    ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                    ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                    ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
                    ->leftjoin('users AS cb','cb.id', 'trip.trip_takenby')
                    ->where('trip.completed_on','=',null)
                    
                    ->orWhere('trip.trip_date','>=',date('Y-m-d'));
                
                }else{

                    $query = Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name,cb.fname as takenby'))
                    ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                    ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                    ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                    ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                    ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                    ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                    ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                    ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
                    ->leftjoin('users AS cb','cb.id', 'trip.trip_takenby');
                }
        
        $result =  $query->get();

        return $result; 
    }


    public static function getOwnTrip($comp_id){
        
        $query = Trip::select(\DB::raw('*,trip.id as id, trip.route_id as r_id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name,cb.fname as takenby'))
                    ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                    ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                    ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                    ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                    ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                    ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                    ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                    ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
                    ->leftjoin('users AS cb','cb.id', 'trip.trip_takenby')
                    ->where('trip.trip_owner_user_id', Auth::id());
        
        $result =  $query->get();

        return $result; 
    }

    public static function getreturnTrip($data,$output){
        $trip_ids=[];
        if($data == 1){
            $query = Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name,cb.fname as takenby'))
                    ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                    ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                    ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                    ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                    ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                    ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                    ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                    ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
                    ->leftjoin('users AS cb','cb.id', 'trip.trip_takenby');
                
                }else{

                    $query = Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name,cb.fname as takenby'))
                    ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                    ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                    ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                    ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                    ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                    ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                    ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                    ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
                    ->leftjoin('users AS cb','cb.id', 'trip.trip_takenby')
                    ->where(function ($query) use ($output) {
                        $query->where('trip.id', [$output]);
                    });

                }
        
                $result =  $query->get();
                return $result; 
    }

    public static function FormLocation($distance,$trip_id)
    {
        $trip = Trip::where('id','=',$trip_id)->first();

        $latitude=$trip->from_latitude;
        $longitude=$trip->from_longitude;

        return $query = Trip::selectRaw("id as id,(1.609344 * 3956 * acos( cos( radians('$latitude') ) * cos( radians(from_latitude) ) * cos( radians(from_longitude) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians(from_latitude) ) ) ) AS distance")
                        ->having('distance', '<', $distance)
                        ->orderBy('distance')->get();
    }

    public static function ToLocation($distance,$trip_id)
    {
        $trip = Trip::where('id','=',$trip_id)->first();        

        $to_latitude=$trip->to_latitude;
        $to_longitude=$trip->to_longitude;

        return $query = Trip::selectRaw("id as id,(1.609344 * 3956 * acos( cos( radians('$to_latitude') ) * cos( radians(to_latitude) ) * cos( radians(to_longitude) - radians('$to_longitude') ) + sin( radians('$to_latitude') ) * sin( radians(to_latitude) ) ) ) AS distance")
                    ->having('distance', '<', $distance)
                    ->orderBy('distance')->get();
    }

    public static function LiveToLocation($distance,$longitude,$latitude)
    { 
        $to_latitude=$latitude;
        $to_longitude=$longitude;

        return $query = Trip::selectRaw("id as id,(1.609344 * 3956 * acos( cos( radians('$to_latitude') ) * cos( radians(to_latitude) ) * cos( radians(to_longitude) - radians('$to_longitude') ) + sin( radians('$to_latitude') ) * sin( radians(from_latitude) ) ) ) AS distance")
                    ->having('distance', '<', $distance)
                    ->orderBy('distance')->get();
    }

}