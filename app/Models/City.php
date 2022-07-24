<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class City extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "city";

    protected $fillable = [
        'country_id',
        'state_id',
        'city_name',
        'description',
    ];
   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public static function getCity(){
        
        $query = City::select(\DB::raw('*,city.id as id'))
                //->leftjoin('country AS c','c.id', 'city.country_id')
                ->leftjoin('state AS s','s.id', 'city.state_id');
        $result =  $query->get();

        return $result; 
    }

}