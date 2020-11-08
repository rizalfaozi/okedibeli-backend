<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comment
 * @package App\Models
 * @version September 5, 2018, 10:08 am UTC
 *
 * @property integer user_id
 * @property string url
 * @property string description
 * @property integer status
 */
class Comment extends Model
{
    use SoftDeletes;

    public $table = 'comment';
    

  protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'url',
        'description',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'url' => 'string',
        'description' => 'string',
        'status' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'url' => 'required',
        'status' => 'required'
    ];


     public function user()
    {
        return $this->belongsTo('App\Models\Member');
    }

    
}
