<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Flash;
use Response;
use Illuminate\Support\Facades\View;
use App\Repositories\ContactRepository;

class ContactController extends AppBaseController
{
    /** @var  MemberRepository */
    private $contactRepository;

    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepository = $contactRepo;
        $this->className = 'contact';
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
        $page = "Contact";
        $this->contactRepository->pushCriteria(new RequestCriteria($request));
        $contact = $this->contactRepository->all();
    
        return view('admin.contact')
            ->with(['contact'=> $contact,'page'=>$page]);
    }

}
