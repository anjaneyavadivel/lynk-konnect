<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class State extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "state";

    protected $fillable = [
        'country_id',
        'state_name',
        'description',
    ];
   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public static function getState(){
        
        $query = State::select(\DB::raw('*,state.id as id'))
        ->leftjoin('country AS c','c.id', 'state.country_id');
        //->leftjoin('roles AS r','r.id', 'mhr.role_id');
        $result =  $query->get();

        return $result; 
    }

}