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
class Fiture extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'fiture';   
    public $timestamps = false;   

    protected $fillable = [
        'title', 'description','file','status','created_at'
    ];


    protected $casts = [
    
        'title' => 'string',
        'description' => 'text',
        'file'=>'string',
        'status' => 'string',
        'created_at' => 'timestamps'
    ];
    
}
