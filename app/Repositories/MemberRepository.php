<?php

namespace App\Repositories;

use App\Models\Member;
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
class MemberRepository extends BaseRepository
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
        'date_start',
        'date_end',
        'office_name',
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
        return Member::class;
    }

    public function getWithLimit($limit=20,$type)
    {
        $data = Member::where('type',$type)->orderby('id', 'desc')->Paginate($limit);
        return $data;
    }

    public function getCount()
    {
        $count = Member::count();
        return $count;
    }

    public function getSearch($requestData, $limit=20)
    {
          $id = $requestData['id'];
          $email = $requestData['email'];
          $username = $requestData['username'];
          $fullname = $requestData['fullname'];
          $startdate = $requestData['startdate'];
          $endate = $requestData['enddate'];

        if($startdate !="" && $endate !="")
        {
              $res = array();
              $res['id'] = $id;
              $res['email'] = $email;
              $res['username'] = $username;
              $res['fullname'] = $fullname;

             $data = Member::filter($res)->whereBetween('created_at', [$startdate.' 00:00:00',$endate.' 23:59:59'])->orderby('id', 'desc')->Paginate($limit);

        }else{
          $data = Member::filter($requestData)->orderby('id', 'desc')->Paginate($limit);    
        }    
        
        return $data;
    }
}
