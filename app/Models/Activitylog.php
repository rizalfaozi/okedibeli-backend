<?php

namespace App\Models;
use EloquentFilter\Filterable;

use Mongoloquent;

/**
 * Class Member
 * @package App\Models
 * @version July 6, 2018, 8:21 am UTC
 *
 * @property string name
 */
class Activity extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'activity_log';   
    public $timestamps = false;   

    protected $fillable = [
        'type', 'memberid', 'email','username','point','c_date','c_timestamp','c_dateMongodb','status','last_update'
    ];


    protected $casts = [
        'login' => 'string',
        'memberid'=>'integer',
        'email' => 'string',
        'username' => 'string',
        'point' => 'string',
        'c_date' => 'timestamps',
        'c_timestamp'=>'integer',
        'c_dateMongodb'=>'date',
        'status'=>'integer',
        'last_update'=>'timestamps',
    ];
    
}
