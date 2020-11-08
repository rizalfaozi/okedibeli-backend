<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
/**
 * Class Member
 * @package App\Models
 * @version July 6, 2018, 8:21 am UTC
 *
 * @property string name
 */
class User extends Model implements AuthenticatableContract
{
    //use SoftDeletes;
    use Authenticatable, Filterable;
    
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
        'datestart',
        'dateend',
        'officename',
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
        'datestart'=>'date',
        'dateend'=>'date',
        'officename'=>'string',
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
