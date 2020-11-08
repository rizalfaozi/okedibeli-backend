<?php
namespace App\Http\Controllers\API;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Facades\Validator;
use File;

class SlideController extends AppBaseController
{   
    private $Slide;
    public function __construct()
    {
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
        $this->UploadFolder = $this->Cfg['general']['uploadSlideFolder'];
        $this->domain = $this->Cfg['general']['domain'];
        
    }

    public function lists(Request $request)
    {
        $_tempResult = Slide::orderby('create_at', 'desc')->Paginate($this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);

    }

    public function editSlide($id)
    {
        $checked = "";
        $results = array();
        $_res = Slide::find($id);
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results['id'] = $_res->id;
        $results['titleslide'] = $_res['titleslide'];
        $results['url'] = $_res['url'];
        $results['position'] = $_res['position'];
        $results['image'] = $_res['image'];
        // $results['startdate'] = $_res['startdate'];
        // $results['startdateiso'] = $_res['startdateiso'];
        // $results['enddate'] = $_res['enddate'];
        // $results['enddateiso'] = $_res['enddateiso'];
        // $results['imageurl'] = url('/'.$this->UploadFolder.$_res['image']);

        $url_media = getenv('MEDIA_URL').'/slider/'.$_res['image'];
        $results['imageurl'] = !empty($_res['image']) ? $url_media : url('/images/not-found.png');
        $results['active'] = $_res['active'];
       
        return response()->json($results);

    }

    public function updateSlide($id, Request $request){

        $err = array();
        $fields = [
            'titleslide' => 'Title',
            'position'  => 'Position',
            'uploadimage'  => 'Upload Image',
            // 'url'  => 'Url',
            // 'startdate'  => 'Start Date',
            // 'enddate'  => 'End Date',  
        ];

        $validationImg = array();
        
        if ($request->hasFile('uploadimage')){
            $validationImg['uploadimage'] = "required|mimes:jpg,jpeg,png,gif";
        }
        
        $validator =  Validator::make($request->all(), array_merge([
            'titleslide' => 'required|max:255',
            'position' => 'required|numeric',
            // 'url' => 'required|url',
            // 'startdate' => 'required',
            // 'enddate' => 'required|after:startdate',
        ],$validationImg));
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();

            if($errors->has('titleslide')){
                $err['messages']['titleslide'] = $errors->first('titleslide');
            }

            if($errors->has('position')){
                $err['messages']['position'] = $errors->first('position');
            }

            if($errors->has('uploadimage')){
                $err['messages']['uploadimage'] = $errors->first('uploadimage');
            }

            // if($errors->has('url')){
            //     $err['messages']['url'] = $errors->first('url');
            // }

            // if($errors->has('startdate')){
            //     $err['messages']['startdate'] = $errors->first('startdate');
            // }

            // if($errors->has('enddate')){
            //     $err['messages']['enddate'] = $errors->first('enddate');
            // }

            return response()->json($err);
        }
        
        if ($request->hasFile('uploadimage')){
            
            // if(file_exists($this->UploadFolder.$request['image'])) {
            //     File::delete($this->UploadFolder.$request['image']);
            // }
           
            $img = $request->file('uploadimage');
            $nameImg = str_slug($request['titleslide']).'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();
            $img->move($this->UploadFolder, $nameImg);
            
            // $new_path_crop = __DIR__ . '/../../../../../member.arkadia.me/public_media/slider'; 
            // $img->move($new_path_crop, $nameImg);

            $dataImg['image'] = $nameImg;
        }

        $data = [
            'titleslide' => $request['titleslide'],
            'position' => $request['position'],
            'active' => ($request['actived'] == 'true' ) ? 'Y' : 'N',
            'create_at' => date('Y-m-d H:i:s'),
            //'url' => trim($request['url']),
            // 'startdate' => date('Y-m-d H:i:s', strtotime($request['startdate'])),
            // 'startdateiso' => $request['startdate'],
            // 'enddate' => date('Y-m-d H:i:s', strtotime($request['enddate'])),
            // 'enddateiso' => $request['enddate'],
        ]; 

        $data = isset($nameImg) ? array_merge($data, $dataImg) : $data;
       
        $save = Slide::where("_id",$id)->update($data);
        $saveId = $save;
        if($saveId){
            $this->clearCache();

            if ($request->hasFile('uploadimage')){
                $this->transferImage($nameImg, "update", $request['image']);
                File::delete($this->UploadFolder.$nameImg);
            }
            
            return response()->json(['id'=>$saveId]);
        }   
    }

    public function postSlide(Request $request)
    {
        
        $fields = [
            'titleslide' => 'Title',
            'position'  => 'Position',
            'uploadimage'  => 'Upload Image',
            // 'url'  => 'Url',
            // 'startdate'  => 'Start Date',
            // 'enddate'  => 'End Date',
        ];

        $validator =  Validator::make($request->all(), [
            'titleslide' => 'required|max:255',
            'position' => 'required|numeric',
            'uploadimage' => 'required|mimes:jpeg,jpg,png,gif',
            // 'url' => 'required|url',
            // 'startdate' => 'required',
            // 'enddate' => 'required|after:startdate',
        ]);
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();

            if($errors->has('titleslide')){
                $err['messages']['titleslide'] = $errors->first('titleslide');
            }

            if($errors->has('position')){
                $err['messages']['position'] = $errors->first('position');
            }

            if($errors->has('uploadimage')){
                $err['messages']['uploadimage'] = $errors->first('uploadimage');
            }

            // if($errors->has('url')){
            //     $err['messages']['url'] = $errors->first('url');
            // }

            // if($errors->has('startdate')){
            //     $err['messages']['startdate'] = $errors->first('startdate');
            // }

            // if($errors->has('enddate')){
            //     $err['messages']['enddate'] = $errors->first('enddate');
            // }

            return response()->json($err);
        }

        $img = $request->file('uploadimage');
        $nameImg = str_slug($request['titleslide']).'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();

        //$new_path_crop = __DIR__ . '/../../../../../member.arkadia.me/public_media/slider'; 
        //file_put_contents($new_path_crop, $nameImg);
        //move_uploaded_file($tmp, $new_path_crop);
       
        $img->move($this->UploadFolder, $nameImg);
       
        $data = [
            'titleslide' => $request['titleslide'],
            'position' => $request['position'],
            'image' => $nameImg,
            'active' => ($request['actived'] == 'true' ) ? 'Y' : 'N',
            'create_at' => date('Y-m-d H:i:s'),
            // 'url' => trim($request['url']),
            // 'startdate' => date('Y-m-d H:i:s', strtotime($request['startdate'])),
            // 'startdateiso' => $request['startdate'],
            // 'enddate' => date('Y-m-d H:i:s', strtotime($request['enddate'])),
            // 'enddateiso' => $request['enddate'],
        ];  

        $save = Slide::create($data);
        if($save->id){
            $this->clearCache();

            $this->transferImage($nameImg);
            File::delete($this->UploadFolder.$nameImg);

            return response()->json(['id'=>$save->id]);
        }   
    }

    public function searchSlide(Request $request)
    {
        
        $_tempResult = Slide::filter($request->all())->orderby('_id', 'desc')->Paginate($this->perPage);
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
            $__temp_[$key]['titleslide'] = $val['titleslide'];
            $__temp_[$key]['position'] = $val['position'];
            $__temp_[$key]['image'] = $val['image'];
            
            $url_media = getenv('MEDIA_URL').'/slider/'.$val['image'];
            $__temp_[$key]['imageurl'] = !empty($val['image']) ? $url_media : url('/images/not-found.png');
            $__temp_[$key]['active'] = $val['active'];
            $__temp_[$key]['create_at'] = $val['create_at'];
            // $__temp_[$key]['startdate'] = $val['startdate'];
            // $__temp_[$key]['enddate'] = $val['enddate'];
            // $__temp_[$key]['url'] = $val['url'];
            
        }
       
        $results['data'] = $__temp_;
        $results['total'] = $data->total();
        $results['lastPage'] = $data->lastPage();
        $results['perPage'] = $data->perPage();
        $results['currentPage'] = $data->currentPage();
        $results['nextPageUrl'] = $data->nextPageUrl();

        return $results;

    }

    public function deleteSlide($id)
    {
        $messages['messages'] = false;
        $_res = Slide::find($id);
          
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }else{

            // $url_media =  __DIR__ . '/../../../../../member.arkadia.me/public_media/slider/'.$_res['image'];
            // if(file_exists($url_media)) {
            //     File::delete($url_media);
             
            // }

            if(file_exists($this->UploadFolder.$_res['image'])) {
                File::delete($this->UploadFolder.$_res['image']);
            }

            $this->transferImage($_res['image'], 'delete');
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

    public function transferImage($images="", $status="insert", $rmvimg=""){
        
        $path = $this->domain['member'].'imagestransfer/getImages';
        if($status == 'delete'){
            $path = $this->domain['member'].'imagestransfer/deleteImages';
        }
        
        $downloadImages = $this->domain['melon'].'images/slide/'.$images;

        $helpersGeneral = new GeneralHelpers();

        $params['file'] = 'transferImage.sh';
        $params['path'] = $path;
        $params['data'] = "'".serialize(['images'=>$downloadImages,'filename'=>$images,'rmvimg'=>$rmvimg, 'folder'=>'slider'])."'";
    
        $result = $helpersGeneral->excuteFileSh($params);  

    
    }

}

?>
