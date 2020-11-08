<?php
namespace App\ModelFilters;	
use EloquentFilter\ModelFilter;

class PanduanFilter extends ModelFilter
{
	
    public $relations = [];
    
	public function id($id)
    {
        return $this->where('id', $id);
    }

    public function username($username)
    {
        return $this->where('username', 'LIKE', '%' . $username . '%');
    }

    

}
?>