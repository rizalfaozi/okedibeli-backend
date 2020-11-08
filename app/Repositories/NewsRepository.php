<?php

namespace App\Repositories;

use App\Models\News;
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
class NewsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
      
        'title'
        ,'summary'
        ,'user_id'
        ,'description'
        ,'status'
        ,'file'
        ,'created_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return News::class;
    }

    public function getWithLimit($limit=20)
    {
        $data = News::orderby('id', 'desc')->Paginate($limit);
        return $data;
    }

    public function getCount()
    {
        $count = News::count();
        return $count;
    }

   
}
