<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\View;
use App\Models\Themes;

class ThemesController extends AppBaseController
{
    /** @var  MemberRepository */
    private $typeRepository;

    public function __construct(Themes $typeRepo)
    {
        $this->typeRepository = $typeRepo;
        $this->className = 'themes';
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
        $page = "Themes";
        $getType = $this->typeRepository->orderby('id', 'desc')->Paginate(20);
        return view('admin.themes')
            ->with(['themes'=> $getType,'page'=>$page]);
    }

}
