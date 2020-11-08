<?php
namespace App\ModelFilters;	
use EloquentFilter\ModelFilter;

class RedeemHistoryFilter extends ModelFilter
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

    public function judul($judul)
    {
        return $this->where('judul', 'LIKE', '%' . $judul . '%');
    }

    public function point($point)
    {
        return $this->where('point', 'LIKE', '%' . $point . '%');
    }

}
?>