<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use DB;

class Stops extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "stops";

    protected $fillable = [
        'route_id',
        'stop_state_id',
        'stop_city_id',
        'position',
        'description',
    ];
   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public static function getStops($id){
        
        $query = Stops::select(\DB::raw('*,stops.id as id'))
                 ->leftjoin('routes AS r','r.id', 'stops.route_id')
                 ->leftjoin('state AS s','s.id', 'stops.stop_state_id')
                 ->leftjoin('city AS c','c.id', 'stops.stop_city_id')
                 ->where('stops.route_id', $id);

        $result =  $query->get();

        return $result; 
    }

    public static function createStops($data){

        $user = app('auth')->getUser();
        
        $stateCount = count($data['stop_state_id']);
        for ($i = 0; $i < $stateCount; $i++) {
            DB::table('stops')->insert([
                'route_id'        => $data['route_id'],
                'stop_state_id'   => $data['stop_state_id'][$i],
                'stop_city_id'    => $data['stop_city_id'][$i],
                'position'        => $data['position'][$i],
                'description'     => $data['description'],
                'created_at' => date("Y-m-d H:i:s"),
                
            ]);
           
        }

        return 1;

    }

    public static function getRouteId($fromStateId,$toStateId){

         $query = Stops::select(\DB::raw('stops.route_id as routeId'))
                     ->join('stops AS b', function ($join) {
                        $join->on('b.route_id', '=', 'stops.route_id')->on('stops.position', '<', 'b.position');
                      })
                     ->where([
                        ['stops.stop_state_id','=', $fromStateId],
                        ['b.stop_state_id','=', $toStateId]
                     ]);

        $result =  $query->get();
        return $result; 
    }

    public static function getReturnRouteId($fromStateId,$toStateId){

         $query = Stops::select(\DB::raw('stops.route_id as routeId'))
                     ->join('stops AS b', function ($join) {
                        $join->on('b.route_id', '=', 'stops.route_id')->on('stops.position', '<', 'b.position');
                      })
                     ->where([
                        ['stops.stop_state_id','=', $toStateId],
                        ['b.stop_state_id','=', $fromStateId]
                     ]);

        $result =  $query->get();
        return $result; 
    }  

     


}