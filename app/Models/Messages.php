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
class Messages extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'messages_list';   
    public $timestamps = false;   

    protected $fillable = [
         'title'
        ,'description'
        ,'kode'
        ,'status'
        ,'created_at'
        ,'updated_at'
        
        
    ];


    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'kode' => 'integer',
        'status' => 'string',
        'created_at' => 'timestamps',
        'updated_at' => 'timestamps',
    ];
    
}
