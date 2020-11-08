<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use App\Models\Point;
use App\Models\RedeemMember;
use App\Models\RedeemHistory;
use App\Models\Activitylog;
use DB;
use JWTAuthException;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RedeemRepository;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Helpers\GeneralHelpers;

class HistoryController extends Controller
{   
    private $RedeemRepository;
    public function __construct(RedeemRepository $redeemRepo)
    {
        $this->redeemRepository = $redeemRepo;
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
        
    }

 

    public function active($id='', $active='N')
    {
        
        $dataPost['status'] = $active;
        //$pointResult = Point::where(['memberid'=>1])->update(['point'=>1500]);
        $redeem = $this->redeemRepository->find($id);
        $userRedeem = RedeemMember::where(['user_id'=>$redeem->user_id,'redeem_id'=>$redeem->redeem_id])->count();
        $pointUser = Point::where('memberid',$redeem->user_id)->first(); 
        if($redeem->redeem_type =="artikel")
        {   
            $type = 'artikel';  
            if($userRedeem >1)
            {
              $status = false;  
            }else{
              $status = true;
              $sukses = 'Redeem '.$__temp->judul.' Berhasil dikonfirmasi';
                    $createhistory = RedeemHistory::insert(['user_id'=>$__temp->user_id,'username'=>$__temp->username,'redeem_id'=>$__temp->redeem_id,'judul'=>$__temp->judul,'point'=>$__temp->point,'redeem_type'=>$__temp->redeem_type,'deskripsi'=>$sukses,'created_at'=>date('Y-m-d H:i:s')]);

              $log = Activitylog::insert(['type'=>'redeem','memberid'=>$__temp->user_id,'email'=>'','point'=>$pointUser->point,'c_date'=>date('Y-m-d H:i:s'),'c_timestamp'=>date('Y-m-d H:i:s'),'c_dateMongodb'=>date('Y-m-d H:i:s'),'status'=>1,'last_update'=>date('Y-m-d H:i:s')]);

            } 

        }else{
          
             $type = 'poin'; 
            if($redeem->status =="N")
            {
                if($pointUser->point > $redeem->point || $pointUser->point == $redeem->point)
                {
                    $__temp = $this->redeemRepository->update($dataPost, $id);
                    $pointTotal = $pointUser->point - $redeem->point;
                    $pointResult = Point::where(['memberid'=>$__temp->user_id])->update(['point'=>$pointTotal]);
                    $sukses = 'Redeem '.$__temp->judul.' Berhasil dikonfirmasi';
                    $createhistory = RedeemHistory::insert(['user_id'=>$__temp->user_id,'username'=>$__temp->username,'redeem_id'=>$__temp->redeem_id,'judul'=>$__temp->judul,'point'=>$__temp->point,'redeem_type'=>$__temp->redeem_type,'deskripsi'=>$sukses,'created_at'=>date('Y-m-d H:i:s')]);
                    $log = Activitylog::insert(['type'=>'redeem','memberid'=>$__temp->user_id,'email'=>'','point'=>$pointTotal,'c_date'=>date('Y-m-d H:i:s'),'c_timestamp'=>date('Y-m-d H:i:s'),'c_dateMongodb'=>date('Y-m-d H:i:s'),'status'=>1,'last_update'=>date('Y-m-d H:i:s')]);
                    $status = true;
                    
                }else{
                   $status = false;
                  
                }   
            }else{
                $status = false;
                
            }   
        }    
       

         
        $results['type'] = $type; 
        $results['status'] = $status;
       // // $results['data'] = $pointResult;
         return response()->json($results);
    }

    public function lists(Request $request)
    {


        $this->redeemRepository->pushCriteria(new RequestCriteria($request));
        $_tempResult = $this->redeemRepository->getWithLimit($this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);
    }

    public function search(Request $request)
    {
        
        $this->redeemRepository->pushCriteria(new RequestCriteria($request));
        $_tempResult = $this->redeemRepository->getSearch($request->all(), $this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);
    }
   

    function __build($data, $request){

        $__temp_ = array();

        $getRequest = $request->all();
        
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$this->perPage) - ($this->perPage-1));

        foreach ($data as $key => $val) {
            $__temp_[$key]['number'] = $numberNext++;
            $__temp_[$key]['id'] = $val['id'];
            $__temp_[$key]['username'] = $val['username'];
            $__temp_[$key]['judul'] = $val['judul'];
            $__temp_[$key]['redeem_type'] = $val['redeem_type'];
            $__temp_[$key]['point'] = $val['point'];
          
            $__temp_[$key]['status'] = $val['status'];
            $created_at = (string) $val['created_at'];
            $__temp_[$key]['created_at'] = GeneralHelpers::tanggal_indo($created_at);
        }

        $results['data'] = $__temp_;
        $results['total'] = $data->total();
        $results['lastPage'] = $data->lastPage();
        $results['perPage'] = $data->perPage();
        $results['currentPage'] = $data->currentPage();
        $results['nextPageUrl'] = $data->nextPageUrl();

        return $results;

    }


    
}  