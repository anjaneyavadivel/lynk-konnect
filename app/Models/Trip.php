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
    ];
    

    

    public static function getTrip($rid=null){
        if($rid == null){
        $query = Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name'))
                    ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                    ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                    ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                    ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                    ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                    ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                    ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                    ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id');
                
                }else{

                    $query = Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name'))
                    ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                    ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                    ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                    ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                    ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                    ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                    ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                    ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
                    ->where('trip.return_route_id', $rid);

                }
        
        $result =  $query->get();

        return $result; 
    }


    public static function getOwnTrip($comp_id){
        
        $query = Trip::select(\DB::raw('*,trip.id as id, trip.route_id as r_id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name'))
                    ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                    ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                    ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                    ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                    ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                    ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                    ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                    ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id')
                    ->where('trip.trip_owner_user_id', Auth::id());
        
        $result =  $query->get();

        return $result; 
    }

    

}