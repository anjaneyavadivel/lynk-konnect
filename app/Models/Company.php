<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Company extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "company";

    protected $fillable = [
        'company_name',
        'address',
        'landmark',
        'state_id',
        'city_id',
        'latitude',
        'longitutude',
        'postcode',
        'contact_person',
        'contact_no1',
        'contact_no2',
        'licence',
        'website',
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

    public static function getCompany(){
        
        $query = Company::select(\DB::raw('*,company.id as id'));
        //->leftjoin('model_has_roles AS mhr','mhr.model_id', 'users.id')
        //->leftjoin('roles AS r','r.id', 'mhr.role_id');
        $result =  $query->get();

        return $result; 
    }

}