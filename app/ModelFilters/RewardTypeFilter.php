<?php
namespace App\ModelFilters;	
use EloquentFilter\ModelFilter;

class RewardTypeFilter extends ModelFilter
{
	
    public $relations = [];
    
	public function id($id)
    {
        return $this->where('_id', $id);
    }

    public function name($name)
    {
        return $this->where('name', 'LIKE', '%' . $name . '%');
    }

    public function point($point)
    {
        return $this->where('point', (int) $point);
    }

}
?>