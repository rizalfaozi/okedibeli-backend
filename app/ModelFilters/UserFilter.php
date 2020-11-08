<?php
namespace App\ModelFilters;	
use EloquentFilter\ModelFilter;

class UserFilter extends ModelFilter
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
        return $this->where('name', 'LIKE', '%' . $fullname . '%');
    }

    public function email($email)
    {
        return $this->where('email', 'LIKE', '%' . $email . '%');
    }

}
?>