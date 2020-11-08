<?php
namespace App\ModelFilters;	
use EloquentFilter\ModelFilter;

class MemberFilter extends ModelFilter
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

    public function fullname($fullname)
    {
        return $this->where('fullname', 'LIKE', '%' . $fullname . '%');
    }

    public function email($email)
    {
        return $this->where('email', 'LIKE', '%' . $email . '%');
    }

}
?>