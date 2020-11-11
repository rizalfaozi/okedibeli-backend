<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Auth;
use DB;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 

    public function __construct()
    {
        $this->className = 'homes';
        View::share('vuejs', $this->className);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = "Dashboard";

        return view('home')->with(['page'=>$page]);
    }


    
}
