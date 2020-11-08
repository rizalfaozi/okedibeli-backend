<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Auth;
use DB;
use App\Models\Content;
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
    private $contentRepository;

    public function __construct(Content $contentRepo)
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


    function _build_data($data){

        $__temp_ = array();
        foreach ($data as $key => $val)
        {
            $__temp_[$key]['id'] = $val['_id'];
            $__temp_[$key]['judul'] = $val['judul'];
            $__temp_[$key]['deskripsi'] = $val['slug'];
            $__temp_[$key]['konten'] = $val['konten'];
            $__temp_[$key]['konten'] = $val['konten'];
            $__temp_[$key]['kategori'] = $val['kategori'];
            $__temp_[$key]['status'] = $val['status'];
            $__temp_[$key]['create_date'] = $val['create_date'];
        }
       
        $results['data'] = $__temp_;
       
 
        return $results;

    }


    function _build_count($data){
         $__temp_ = array();
        foreach ($data as $key => $val)
        {
             $__temp_[$key]['id'] = $val['_id'];
        }
        $results['total'] = count($__temp_);
        return $results;

    }
}
