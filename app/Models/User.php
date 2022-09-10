<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'company_id',
        'role_id',
        'otp'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getUsers($company_id_s){
        
       // $company_id_s =  Session::get('company_id_s');
        if($company_id_s == 0){
            $query = User::select(\DB::raw('*,users.id as id,users.fname as fname, r.name as role_name,d.id as driverid'))
            ->leftjoin('company AS c','c.id', 'users.company_id')
           // ->leftjoin('model_has_roles AS mhr','mhr.model_id', 'users.id')
            ->leftjoin('roles AS r','r.id', 'users.role_id')
            ->leftjoin('driver AS d','d.user_id', 'users.id')
            ->orderBy('users.id', 'ASC');
            $result =  $query->get();
            
        }else{
            $query = User::select(\DB::raw('*,users.id as id,users.fname as fname, r.name as role_name'))
            ->leftjoin('company AS c','c.id', 'users.company_id')
            ->leftjoin('model_has_roles AS mhr','mhr.model_id', 'users.id')
            ->leftjoin('roles AS r','r.id', 'mhr.role_id')
            ->where('users.company_id', $company_id_s);
            $result =  $query->get();
        }

        return $result; 
    }

}