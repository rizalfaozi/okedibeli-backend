<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;

/**
 * Class Member
 * @package App\Models
 * @version July 6, 2018, 8:21 am UTC
 *
 * @property string name
 */
class Member extends Model
{
    //use SoftDeletes;
    use Filterable;
    
    public $table = 'users';
    

    //protected $dates = ['deleted_at'];
        

    public $fillable = [
        'username',
        'fullname',
        'photo',
        'email',
        'password',
        'address',
        'domain',
        'packet',
        'date_start',
        'date_end',
        'office_name',
        'instagram',
        'facebook',
        'type',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'username' =>'string',
        'fullname'=>'string',
        'photo'=>'string',
        'email'=>'string',
        'password'=>'string',
        'address'=>'text',
        'domain'=>'string',
        'packet'=>'string',
        'date_start'=>'string',
        'date_end'=>'string',
        'office_name'=>'string',
        'instagram'=>'string',
        'facebook'=>'string',
        'type'=>'string',
        'status'=>'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'username' => 'required'
    ];

    
}
