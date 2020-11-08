<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PostCriteria
 * @package namespace App\Criteria;
 */

   

class UserCriteria implements CriteriaInterface
{

     private $type;
     public function __construct($type)
     {
       $this->type = $type;
       
     }
   
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('type',$this->type)->orderBy('id','desc');    
        return $model;
    }
}
