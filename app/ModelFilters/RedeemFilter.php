<?php
namespace App\ModelFilters; 
use EloquentFilter\ModelFilter;

class RedeemFilter extends ModelFilter
{
    
    public $relations = [];
    
    public function _id($_id)
    {
        return $this->where('_id', $_id);
    }

    public function titlesredeem($titlesredeem)
    {
        return $this->where('titlesredeem', 'LIKE', '%' . $titlesredeem . '%');
    }

}
?>