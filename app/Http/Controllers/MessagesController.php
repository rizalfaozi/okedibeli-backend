<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Illuminate\Support\Facades\View;
use App\Models\Messages;

class MessagesController extends AppBaseController
{
    /** @var  MemberRepository */
    private $typeRepository;

    public function __construct(Messages $typeRepo)
    {
        $this->typeRepository = $typeRepo;
        $this->className = 'messages';
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
        $page = "Messages";
        $getType = $this->typeRepository->orderby('id', 'desc')->Paginate(20);
        return view('activity.messages')
            ->with(['activity.messages'=> $getType,'page'=>$page]);
    }

}
