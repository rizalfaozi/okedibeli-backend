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
class Profile extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'profile';   
    public $timestamps = false;   

    protected $fillable = [
        'user_id'
        ,'title'
        ,'description'
        ,'status'
        ,'file'
        ,'created_at'
        ,'updated_at'
    
       
       
    ];


    protected $casts = [
        'user_id' =>'integer'
        ,'title' =>'string'
        ,'description' =>'text'
        ,'file' =>'string'
        ,'status' => 'string'
        ,'created_at' =>'timestamps'
         ,'updated_at' =>'timestamps'
        
    ];
    
}

