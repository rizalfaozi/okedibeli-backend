<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Auth;
use DB;


use App\Http\Controllers\AppBaseController;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Facades\Validator;
class HomeController extends AppBaseController
{   
    
    private $Point;
    public function __construct()
    {
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
    
        
    }


    public function lists(Request $request)
    {
        

    

    }


  

   

    
}  