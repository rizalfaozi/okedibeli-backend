<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Flash;
use Response;
use Illuminate\Support\Facades\View;
use App\Repositories\ProfileRepository;

class ProfileController extends AppBaseController
{
    /** @var  MemberRepository */
    private $profileRepository;

    public function __construct(ProfileRepository $profileRepo)
    {
        $this->profileRepository = $profileRepo;
        $this->className = 'profile';
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
        $page = "Profile";
        $this->profileRepository->pushCriteria(new RequestCriteria($request));
        $profile = $this->profileRepository->all();
    
        return view('admin.profile')
            ->with(['profile'=> $profile,'page'=>$page]);
    }

}
