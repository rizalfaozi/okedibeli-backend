<?php

namespace App\Http\Controllers;


use App\Repositories\NewsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Illuminate\Support\Facades\View;

class NewsController extends AppBaseController
{
    /** @var  MemberRepository */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepo)
    {
        $this->newsRepository = $newsRepo;
        $this->className = 'news';
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
        $page = "News";
        $this->newsRepository->pushCriteria(new RequestCriteria($request));
        $news = $this->newsRepository->all();
    
        return view('admin.news')
            ->with(['news'=> $news,'page'=>$page]);
    }

}
   

   


