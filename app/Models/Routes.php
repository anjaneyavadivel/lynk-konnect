<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Routes extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "routes";

    protected $fillable = [
        'route_name',
        'from_route_state_id',
        'from_route_city_id',
        'to_route_state_id',
        'to_route_city_id',
        'description',
    ];
   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public static function getRoutes(){
        
        $query = Routes::select(\DB::raw('*,routes.id as id,s.state_name as from_state, c.city_name as from_city, st.state_name as to_state, ct.city_name as to_city'))
                 ->leftjoin('state AS s','s.id', 'routes.from_route_state_id')
                 ->leftjoin('city AS c','c.id', 'routes.from_route_city_id')
                 ->leftjoin('state AS st','st.id', 'routes.to_route_state_id')
                 ->leftjoin('city AS ct','ct.id', 'routes.to_route_city_id');
        $result =  $query->get();
        return $result; 
    }

}