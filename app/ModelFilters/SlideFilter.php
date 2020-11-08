<?php
namespace App\ModelFilters; 
use EloquentFilter\ModelFilter;

class SlideFilter extends ModelFilter
{
    
    public $relations = [];
    
    public function _id($_id)
    {
        return $this->where('_id', $_id);
    }

    public function titleslide($titleslide)
    {
        return $this->where('titleslide', 'LIKE', '%' . $titleslide . '%');
    }

}
?>