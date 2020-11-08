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
class Contact extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'contact';   
    public $timestamps = false;   

    protected $fillable = [
        'user_id'
        ,'name'
        ,'status'
        ,'created_at'
        ,'updated_at'
       
       
    ];


    protected $casts = [
         'user_id' =>'integer'
        ,'name' =>'string'
        ,'status' =>'text'
        
        ,'created_at' =>'timestamps'
        ,'updated_at' =>'timestamps'
    ];
    
}

