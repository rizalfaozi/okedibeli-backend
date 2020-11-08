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
class Slide extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'slider_yoursay';   
    public $timestamps = false;   

    protected $fillable = [
        'titleslide'
        // ,'url'
        ,'image'
        ,'active'
        ,'create_at'
        ,'update_at'
        // ,'startdate'
        // ,'enddate'
        // ,'startdateiso'
        // ,'enddateiso'
        ,'position'
    ];


    protected $casts = [
        'name' => 'string'
        ,'point' => 'int'
        
    ];
    
}
