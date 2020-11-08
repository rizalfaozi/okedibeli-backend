<?php

namespace App\Http\Controllers;


use App\Repositories\MemberRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\View;

class MemberController extends AppBaseController
{
    /** @var  MemberRepository */
    private $memberRepository;

    public function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepository = $memberRepo;
        $this->className = 'members';
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
         $page = "Member";
        $this->memberRepository->pushCriteria(new RequestCriteria($request));
        $members = $this->memberRepository->all();
    
        return view('admin.members')
            ->with(['members'=> $members,'page'=>$page]);
    }

    

}
