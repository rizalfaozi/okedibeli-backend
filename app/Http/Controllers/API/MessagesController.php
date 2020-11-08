<?php
namespace App\Http\Controllers\API;
use App\Models\Messages;
use App\Models\Member;
use App\Models\Blast;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Facades\Validator;
use File;
use App\Mail\BlastEmail;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Support\Facades\Redis;

class MessagesController extends AppBaseController
{   
    private $Redeem;

    public function __construct()
    {
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
        $this->UploadFolder = $this->Cfg['general']['uploadRedeemFolder'];
        //$this->redis = Redis::connection();

        
    }

    public function lists(Request $request)
    {
        $_tempResult = Messages::orderby('created_at', 'desc')->Paginate($this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);

    }

    public function send($id,$kode,Request $request)
    {
        $Messages = Messages::find($id);
        $title = $Messages->title;
        $description = $Messages->description;
        $user = Member::where('active','Y')->get();
         
         if($kode == count($user))
         {
            $jml = 0;
         }else{
            $jml = $kode;
         }   
        
        $update = Messages::where('_id',$id)->update(['kode'=>$jml,'updated_at'=> date('Y-m-d H:i:s')]);
     
       
       $results = $this->_buildSend($user, $kode,$request, $title,$description);
        return response()->json($results);
 
    }

    public function edit($id)
    {
        $checked = "";
        $results = array();
        $_res = Messages::find($id);
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results['id'] = $_res->id;
        $results['title'] = $_res['title'];
        $results['description'] = $_res['description'];
       
        $results['status'] = $_res['status'];
       
        return response()->json($results);

    }

    public function update($id, Request $request){

        $err = array();
        $fields = [
            'title' => 'Title',
            'description'  => 'Description',
           
        ];

        $validationImg = array();
        
        if ($request->hasFile('uploadimage')){
            $validationImg['uploadimage'] = "required|mimes:jpg,jpeg,png,gif";
        }
        
        $validator =  Validator::make($request->all(), array_merge([
            'title' => 'required|max:255',
            'description' => 'required',
         
        ],$validationImg));
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();

            if($errors->has('title')){
                $err['messages']['title'] = $errors->first('title');
            }

            if($errors->has('description')){
                $err['messages']['description'] = $errors->first('description');
            }

            return response()->json($err);
        }
        
       

        $data = [
            'title' => $request['title'],
            'description' => $request['description'],
           
            'status' => ($request['status'] == 'true' ) ? 'Y' : 'N',
            'updated_at' => date('Y-m-d H:i:s'),
        ]; 

        $data = isset($nameImg) ? array_merge($data, $dataImg) : $data;
       
        $save = Messages::where("_id",$id)->update($data);
        $saveId = $save;
        if($saveId){
            $this->clearCache();
            return response()->json(['id'=>$saveId]);
        }   
    }

    public function store(Request $request)
    {
        
        $fields = [
            'title' => 'Title',
            'description'  => 'Description',
            
        ];

        $validator =  Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
          
        ]);
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();

            if($errors->has('title')){
                $err['messages']['title'] = $errors->first('title');
            }

            if($errors->has('description')){
                $err['messages']['description'] = $errors->first('description');
            }

        

            return response()->json($err);
        }

       
       
        
        $data = [
            'title' => $request['title'],
            'description' => $request['description'],
            'kode'=>0,
            'status' => ($request['status'] == 'true' ) ? 'Y' : 'N',
            'created_at' => date('Y-m-d H:i:s'),
        ];  

        $save = Messages::create($data);
        if($save->id){
            $this->clearCache();
            return response()->json(['id'=>$save->id]);
        }   
    }

    public function search(Request $request)
    {
        
        $_tempResult = Messages::filter($request->all())->orderby('_id', 'desc')->Paginate($this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);
    }



    public function active($id='', $status='N')
    {
        
        $dataPost['status'] = $status;
        $__temp_ = Messages::where("_id",$id)->update(['status'=>$status]);
        
        $results['data'] = $__temp_;
        return response()->json($results);
    }

    function __build($data, $request){

        $__temp_ = array();
        // $this->redis->del('member1');
        // $this->redis->del('member2');
        // $this->redis->del('member3');
        $getRequest = $request->all();
        
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$this->perPage) - ($this->perPage-1));
           $user = Member::where('active','Y')->count();
        foreach ($data as $key => $val) {
            $__temp_[$key]['number'] = $numberNext++;
            $__temp_[$key]['id'] = $val['id'];
            $__temp_[$key]['title'] = $val['title'];
            $__temp_[$key]['kode'] = $val['kode'];
            $__temp_[$key]['description'] = $val['description'];
           
            $__temp_[$key]['status'] = $val['status'];
            $__temp_[$key]['created_at'] = $val['created_at'];
            $__temp_[$key]['total_member'] =  $user;
        }

     
       
        $results['data'] = $__temp_;
        $results['total_member'] =  $user;
        $results['total'] = $data->total();
        $results['lastPage'] = $data->lastPage();
        $results['perPage'] = $data->perPage();
        $results['currentPage'] = $data->currentPage();
        $results['nextPageUrl'] = $data->nextPageUrl();


        return $results;

    }


    function _buildSend($data,$kode, $request,$title,$description){

        $__temp_ = array();

        $getRequest = $request->all();
        
        $page = isset($getRequest['page']) ? $getRequest['page'] : 1;
        $numberNext = (($page*$this->perPage) - ($this->perPage-1));

        foreach ($data as $key => $val) 
        {
          if($kode == $numberNext++)
          {
        
            $__temp_[$key]['number'] = $kode;
            $__temp_[$key]['id'] = $val['id'];
            $__temp_[$key]['username'] = $val['username'];
            $__temp_[$key]['fullname'] = $val['fullname'];
            $__temp_[$key]['email'] = $val['email'];
             $__temp_[$key]['title'] = $title;
             //Mail::to($__temp_[$key]['email'])->send(new BlastEmail($title,$description));


          }  
        }

       //  $response1 =  $this->redis->get('member1');
       //  if(empty($response1))
       //  {

       //      $this->redis->set('member1', json_encode($__temp_));
       //      $datares =  $this->redis->get('member1');
       //      $result = json_decode($datares);
        
       // }else{

       //   if($kode <3)
       //   {   
       //      $data1 = json_decode($response1);
       //      $data2 = $__temp_;
       //      $res1 = array_merge($data1,$data2);

       //      $this->redis->set('member2', json_encode($res1));
       //      $resdata = json_decode($this->redis->get('member2'));
       //      $result = $resdata;

       //   }else{

       //      $resdata = json_decode($this->redis->get('member2'));

       //      $data2 = $__temp_;
       //      $res1 = array_merge($resdata,$data2);
        
       //      $this->redis->set('member2', json_encode($res1)); 
       //      $res2 = json_decode($this->redis->get('member2'));
       //      $result = $res2;
       //   }   
                

       //  } 

        
       
        $results['data'] = $__temp_;
        $results['total'] = count($data);
        // $results['lastPage'] = $data->lastPage();
        // $results['perPage'] = $data->perPage();
        // $results['currentPage'] = $data->currentPage();
        // $results['nextPageUrl'] = $data->nextPageUrl();

        return $results;

    }

    public function merge()
    {

     
        
            $response3 =  $this->redis->get('member2');
            $data1 = json_decode($response3, TRUE);
         
         return json_encode($data1);

    }

    public function inredis($data){
 

        
       

          return json_encode($result);  

    }


    public function delredis(){

        

        $this->redis->del('member1');

    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Messages::find($id);
    
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }else{
            // if(file_exists($this->UploadFolder.$_res['image'])) {
            //     File::delete($this->UploadFolder.$_res['image']);
            // }

            //  $url_media =  __DIR__ . '/../../../../../member.arkadia.me/public_media/redeem/'.$_res['image'];
            // if(file_exists($url_media)) {
            //     File::delete($url_media);
             
            // }
        }

        $results = $_res->delete();

        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }

    public function clearCache(){

        $helpersGeneral = new GeneralHelpers();

        $params['file'] = 'clearCacheType.sh';
        $params['path'] = 'clearcache';
        
        $result = $helpersGeneral->excuteFileSh($params);  

    
    }

}

?>
