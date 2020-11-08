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
class RewardType extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'activity_type';   
    public $timestamps = false;   

    protected $fillable = [
        'name', 'slug', 'point', 'active', 'create_at', 'update_at'
    ];


    protected $casts = [
        'name' => 'string'
        ,'point' => 'int'
        
    ];
    
}
