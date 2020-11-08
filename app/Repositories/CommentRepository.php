<?php

namespace App\Repositories;

use App\Models\Comment;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CommentRepository
 * @package App\Repositories
 * @version September 5, 2018, 10:08 am UTC
 *
 * @method Comment findWithoutFail($id, $columns = ['*'])
 * @method Comment find($id, $columns = ['*'])
 * @method Comment first($columns = ['*'])
*/
class CommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'url',
        'description',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Comment::class;
    }
}
