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
class Point extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'activity_member';   
    public $timestamps = false;   

    protected $fillable = [
        'memberid', 'last_update', 'email','username','point'
    ];


    protected $casts = [
      
        'memberid' => 'int',
        'last_update'=>'timestamps',
        'email' => 'string',
        'username' => 'string',
        'point'=>'string'
        
    ];
    
}
