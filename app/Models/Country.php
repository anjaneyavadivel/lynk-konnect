<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Country extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "country";

    protected $fillable = [
        'country_name',
        'description',
        'flag',
    ];
   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    // public static function getCompany(){
        
    //     $query = Company::select(\DB::raw('*,company.id as id'));
    //     //->leftjoin('model_has_roles AS mhr','mhr.model_id', 'users.id')
    //     //->leftjoin('roles AS r','r.id', 'mhr.role_id');
    //     $result =  $query->get();

    //     return $result; 
    // }

}