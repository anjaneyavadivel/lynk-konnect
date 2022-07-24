<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Transaction extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "transaction";

    protected $fillable = [
        'uniq_id',
        'trip_id',
        'operator_id',
        'status',
    ];
    
  

    public static function getTrip(){
        
        $query = Trip::select(\DB::raw('*,trip.id as id,u.fname as owner_fname, us.fname as confirm_fname, s.state_name as f_state_name, st.state_name as t_state_name'))
                    ->leftjoin('users AS u','u.id', 'trip.trip_owner_user_id')
                    ->leftjoin('users AS us','us.id', 'trip.trip_confirm_user_id')
                    ->leftjoin('state AS s','s.id', 'trip.from_state_id')
                    ->leftjoin('state AS st','st.id', 'trip.to_state_id')
                    ->leftjoin('city AS c','c.id', 'trip.from_city_id')
                    ->leftjoin('city AS ci','ci.id', 'trip.to_city_id')
                    ->leftjoin('company AS com','com.id', 'trip.trip_owner_company_id')
                    ->leftjoin('company AS comp','comp.id', 'trip.trip_confirm_company_id');
        
        $result =  $query->get();

        return $result; 
    }

}