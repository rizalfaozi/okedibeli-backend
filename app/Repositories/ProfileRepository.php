<?php

namespace App\Repositories;

use App\Models\Profile;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MemberRepository
 * @package App\Repositories
 * @version July 6, 2018, 8:21 am UTC
 *
 * @method Member findWithoutFail($id, $columns = ['*'])
 * @method Member find($id, $columns = ['*'])
 * @method Member first($columns = ['*'])
*/
class ProfileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id'
        ,'title'
        ,'description'
        ,'status'
        ,'file'
        ,'created_at'
        ,'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Profile::class;
    }

    public function getWithLimit($limit=20)
    {
        $data = Profile::orderby('id', 'desc')->Paginate($limit);
        return $data;
    }

    public function getCount()
    {
        $count = Profile::count();
        return $count;
    }

    
}
