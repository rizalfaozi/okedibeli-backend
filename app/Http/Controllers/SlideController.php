<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\View;
use App\Models\Slide;

class SlideController extends AppBaseController
{
    /** @var  MemberRepository */
    private $typeRepository;

    public function __construct(Slide $typeRepo)
    {
        $this->typeRepository = $typeRepo;
        $this->className = 'slide';
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
        $page = "Slide";
        $getType = $this->typeRepository->orderby('id', 'desc')->Paginate(20);
        return view('activity.slide')
            ->with(['activity.slide'=> $getType,'page'=>$page]);
    }

}
