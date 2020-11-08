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
class Content extends Mongoloquent
{
    use Filterable;
    
    //use SoftDeletes;
    protected $connection = 'mongodb';   
    protected $collection = 'artikel_yoursay';   
    public $timestamps = false;   

    protected $fillable = [
        '_id', 'judul', 'deskripsi', 'konten', 'youtube', 'kategori','user_id','username','fullname','work','create_date','mongo_create_date','status','file'
    ];


    protected $casts = [
        '_id' => 'int',
        'judul' => 'string',
        'deskripsi'=>'string',
        'konten' => 'text',
        'youtube'=>'string',
        'kategori' => 'string',
        'user_id'=>'int',
        'username' => 'string',
        'fullname'=>'string',
        'work'=>'string',
        'create_date' => 'timestamps',
        'mongo_create_date'=>'timestamps',
        'status' => 'int',
        'file'=>'string',
    ];
    
}
