<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Driver extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "driver";

    protected $fillable = [
        'user_id',
        'badge',
        'address1',
        'address2',
        'state_id',
        'city_id',
        'postcode',
        'contactnumber',
        'created_by',
        'is_active',
    ];

    public static function driverlist(){
        
             $query = User::select(\DB::raw('users.id as id,users.fname as fname,users.lname as lname,users.email as email,c.company_name,d.id as driverid,d.contactnumber'))
             ->leftjoin('company AS c','c.id', 'users.company_id')
             ->leftjoin('driver AS d','d.user_id', 'users.id')
             ->orderBy('users.id', 'desc')
             ->where('users.role_id', '=', 1);
             $result =  $query->get();

 
         return $result; 
     }
}