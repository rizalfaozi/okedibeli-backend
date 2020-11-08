<?php

namespace App\Repositories;

use App\Models\User;
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
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    public function getWithLimit($limit=20,$type)
    {
        $data = User::where('type',$type)->orderby('id', 'desc')->Paginate($limit);
        return $data;
    }

    public function getCount()
    {
        $count = User::count();
        return $count;
    }

    public function getSearch($requestData, $limit=20)
    {
        $data = User::filter($requestData)->orderby('id', 'desc')->Paginate($limit);
        return $data;
    }
}
