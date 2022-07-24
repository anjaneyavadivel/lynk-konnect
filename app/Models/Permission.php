<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Permission extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'guard_name',
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

    // public static function getUsers(){
        
    //     $query = User::select(\DB::raw('*,users.id as id,users.name as fname, r.name as role_name'))
    //     ->leftjoin('model_has_roles AS mhr','mhr.model_id', 'users.id')
    //     ->leftjoin('roles AS r','r.id', 'mhr.role_id');
    //     $result =  $query->get();

    //     return $result; 
    // }

}