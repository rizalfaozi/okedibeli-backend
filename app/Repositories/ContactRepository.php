<?php

namespace App\Repositories;

use App\Models\Contact;
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
class ContactRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
      
        'name'
        ,'status'
        ,'created_at'
        ,'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Contact::class;
    }

    public function getWithLimit($limit=20)
    {
        $data = Contact::orderby('id', 'desc')->Paginate($limit);
        return $data;
    }

    public function getCount()
    {
        $count = Contact::count();
        return $count;
    }

   
}
