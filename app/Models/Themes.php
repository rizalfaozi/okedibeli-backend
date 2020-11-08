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
class Themes extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'themes';   
    public $timestamps = false;   

    protected $fillable = [
        'name'
        ,'summary'
        ,'price'
        ,'description'
        ,'url_demo'
        ,'status'
        ,'file'
        ,'created_at'
    ];


    protected $casts = [
        'name' =>'string'
        ,'summary'=>'string'
        ,'price'=>'integer'
        ,'description'=>'text'
        ,'url_demo'=>'string'
        ,'status'=>'string'
        ,'file'=>'string'
        ,'created_at'=>'timestamps'
        
    ];
    
}
