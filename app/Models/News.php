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
class News extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'news';   
    public $timestamps = false;   

    protected $fillable = [
        'title'
        ,'summary'
        ,'user_id'
        ,'description'
        ,'status'
        ,'file'
        ,'created_at'
    ];


    protected $casts = [
        'title' =>'string'
        ,'user_id'=>'integer'
        ,'summary'=>'string'
        ,'description'=>'text'
        ,'status'=>'string'
        ,'file'=>'string'
        ,'created_at'=>'timestamps'
        
    ];
    
}
