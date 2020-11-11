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
        'phone',
        'password',
        'address',
        'province_id',
        'province_name',
        'city_id',
        'city_name',
        'subdistrict_id',
        'subdistrict_name',
        'photo',
        'type',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' =>'string',
        'phone'=>'string',
        'password'=>'string',
        'address'=>'text',
        'province_id'=>'integer',
        'province_name'=>'string',
        'city_id'=>'integer',
        'city_name'=>'string',
        'subdistrict_id'=>'integer',
        'subdistrict_name'=>'string',
        'photo'=>'string',
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
