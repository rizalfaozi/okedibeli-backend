<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\View;
use App\Repositories\FitureRepository;

class FitureController extends AppBaseController
{
    /** @var  MemberRepository */
    private $fitureRepository;

    public function __construct(FitureRepository $fitureRepo)
    {
        $this->fitureRepository = $fitureRepo;
        $this->className = 'fiture';
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
        $page = "Fiture";
        $this->fitureRepository->pushCriteria(new RequestCriteria($request));
        $members = $this->fitureRepository->all();
        
        return view('admin.fiture')
            ->with(['fiture'=> $members,'page'=>$page]);
    }

}
