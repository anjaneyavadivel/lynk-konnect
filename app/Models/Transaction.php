<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
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
}