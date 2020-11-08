<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Auth;
use DB;
use App\Models\Point;
use App\Models\User;
use App\Models\Content;
use App\Models\RedeemHistory;
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
        $this->UploadFolder = $this->Cfg['general']['uploadSlideFolder'];
        
    }


    public function lists(Request $request)
    {
        $end_date = date('Y-m-d 23:59:59');
        $start_date = date("Y-m-d 00:00:00", strtotime('-14 days', strtotime($end_date)));
        $_tempResult = Point::whereBetween('last_update',[$start_date,$end_date])->orderby('point', 'desc')->limit(15)->Paginate($this->perPage);

        $c_day = User::where('active','Y')->where('created_at','like',''.$end_date.'%')->count();
        $c_month = User::where('active','Y')->where('created_at','like',''.date("Y-m").'%')->count();

        $_tempResult1 = Content::where('status',0)->get();
        $results1 = $this->_build_count($_tempResult1);
        $cont_pending = $results1['total'];

        $_tempResult2 = Content::where('status',1)->get();
        $results2 = $this->_build_count($_tempResult2);
        $cont_publish = $results2['total'];

        $count = array('count_day'=>$c_day,'count_month'=>$c_month,'content_pending'=>$cont_pending,'content_publish'=>$cont_publish);

        $history = RedeemHistory::orderby('created_at','desc')->limit(15)->get();
        
        

        $results = $this->__build($_tempResult,$count,$history,$request);
        return response()->json($results);

    

    }


    function __build($data,$count,$history,$request){

        $__temp_ = array();
        $__his = array();
        $getRequest = $request->all();
        
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$this->perPage) - ($this->perPage-1));

        foreach ($data as $key => $val) {
            $__temp_[$key]['number'] = $numberNext++;
            $__temp_[$key]['id'] = $val['id'];
            $__temp_[$key]['memberid'] = $val['memberid'];
            $__temp_[$key]['email'] = $val['email'];
            $__temp_[$key]['username'] = $val['username'];
            $__temp_[$key]['point'] = $val['point'];
            $__temp_[$key]['last_update'] = $val['last_update'];
        }

        foreach($history as $i => $row)
        {
            if($i ==0)
            {
                $k = 1;
            } 
            if($row['status'] ==0)
            {
                $status = 'pending';
            }else{
                $status = 'sukses';
            }   
            
            $__his_[$i]['number'] = $k++;
            $__his_[$i]['id'] = $row['id'];
            $__his_[$i]['username'] = $row['username'];
            $__his_[$i]['deskripsi'] = $row['deskripsi'];
            $__his_[$i]['type'] = $row['redeem_type'];
            $__his_[$i]['point'] = $row['point'];
            $__his_[$i]['status'] = $status;
        }    

       
        $results['data'] = $__temp_;
        $results['total_day'] = $count['count_day'];
        $results['total_month'] = $count['count_month'];
        $results['content_pending'] = $count['content_pending'];
        $results['content_publish'] = $count['content_publish'];
        $results['history'] =  $__his_;
        $results['total'] = $data->total();
        $results['lastPage'] = $data->lastPage();
        $results['perPage'] = $data->perPage();
        $results['currentPage'] = $data->currentPage();
        $results['nextPageUrl'] = $data->nextPageUrl();

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