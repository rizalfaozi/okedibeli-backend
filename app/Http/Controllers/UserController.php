<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Auth;
use DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends AppBaseController
{
   /** @var  MemberRepository */
    private $adminRepository;

    public function __construct(UserRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
        $this->className = 'admins';
        View::share('vuejs', $this->className);
    }

    /**
     * Display a listing of the Member.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $page = "Admins";
        $this->adminRepository->pushCriteria(new RequestCriteria($request));
        $admin = $this->adminRepository->all();
    
        return view('admin.admins')
            ->with(['admin'=> $admin,'page'=>$page]);
    }


    
 

    
}
