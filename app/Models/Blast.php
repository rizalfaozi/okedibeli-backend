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
class Blast extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'messages_send';   
    public $timestamps = false;   

    protected $fillable = [
        'username'
        ,'email'
        ,'title'
        ,'status'
        ,'created_at'
      
      
        
    ];


    protected $casts = [
        'username'=>'string',
        'email'=>'string',
        'title' => 'string',
        'status'=>'string',
        'created_at' => 'timestamps',
        
    ];
    
}
