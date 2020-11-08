<?php
namespace App\Http\Controllers\API;
use App\Models\Themes;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Facades\Validator;
use File;

class ThemesController extends AppBaseController
{   
    private $Themes;
    public function __construct()
    {
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
        $this->UploadFolder = $this->Cfg['general']['uploadThemesFolder'];
        $this->domain = $this->Cfg['general']['domain'];
    }

    public function lists(Request $request)
    {
        $_tempResult = Themes::orderby('created_at', 'desc')->Paginate($this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);

    }

    public function edit($id)
    {
        $checked = "";
        $results = array();
        $_res = Themes::find($id);
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results['id'] = $_res->id;
        $results['name'] = $_res['name'];
        $results['summary'] = $_res['summary'];
        $results['url_demo'] = $_res['url_demo'];
        $results['description'] = $_res['description'];
 
        $results['price'] = $_res['price'];
        $results['file'] = $_res['file'];
        $url_media = getenv('MEDIA_URL').'/images/themes/'.$_res['file'];
        $results['imageurl'] = !empty($_res['file']) ? $url_media : url('/images/not-found.png');
        $results['status'] = $_res['status'];
       
        
        return response()->json($results);

    }

    public function update($id, Request $request){

        $err = array();
        $fields = [
            'name' => 'Name',
            'description'  => 'Description',
            'summary'  => 'Summary',
            'url_demo'=>'URL Demo', 
            'price' => 'Price',
            'uploadimage'  => 'Upload Image',
            // 'position'  => 'Position',
            
        ];

        $validationImg = array();
        
        if ($request->hasFile('uploadimage')){
            $validationImg['uploadimage'] = "required|mimes:jpg,jpeg,png,gif";
        }
        
        $validator =  Validator::make($request->all(), array_merge([
            'name' => 'required|max:255',
            'description' => 'required',
            'summary' => 'required',
            'price' => 'required|numeric',
            'url_demo' => 'required',
        ],$validationImg));
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();

            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('description')){
                $err['messages']['description'] = $errors->first('description');
            }

             if($errors->has('summary')){
                $err['messages']['summary'] = $errors->first('summary');
            }

            if($errors->has('url_demo')){
                $err['messages']['url_demo'] = $errors->first('url_demo');
            }

      

            if($errors->has('price')){
                $err['messages']['price'] = $errors->first('price');
            }

            if($errors->has('uploadimage')){
                $err['messages']['uploadimage'] = $errors->first('uploadimage');
            }

       

            return response()->json($err);
        }
        
        if ($request->hasFile('uploadimage'))
        {

            $_resi = Themes::find($id);
            File::delete($this->UploadFolder.$_resi['file']);
         
            $img = $request->file('uploadimage');
            $nameImg = str_slug($request['name']).'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();
            $img->move($this->UploadFolder, $nameImg);
            $dataImg['file'] = $nameImg;
        }

        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'summary' => $request['summary'],
            'url_demo' =>$request['url_demo'],
            'price' => $request['price'],
            'status' => ($request['status'] == 'true' ) ? 'Y' : 'N',
            'created_at' => date('Y-m-d H:i:s'),
            
        ]; 

        $data = isset($nameImg) ? array_merge($data, $dataImg) : $data;
       
        $save = Themes::where("_id",$id)->update($data);
        $saveId = $save;
        if($saveId){
            //$this->clearCache();

            return response()->json(['id'=>$saveId]);
        }   
    }

    public function post(Request $request)
    {
        
         $fields = [
            'name' => 'Name',
            'description'  => 'Description',
            'summary'  => 'Summary',
            'url_demo'=>'URL Demo',
            'price' => 'Price',
            'uploadimage'  => 'Upload Image',
           
            
        ];

        $validator =  Validator::make($request->all(), [
            'name' => 'required|max:255',
            'summary' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'url_demo' =>'required',
            'uploadimage' => 'required|mimes:jpeg,jpg,png,gif',
          
        ]);


        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();

            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('description')){
                $err['messages']['description'] = $errors->first('description');
            }

            if($errors->has('summary')){
                $err['messages']['summary'] = $errors->first('summary');
            }

            if($errors->has('url_demo')){
                $err['messages']['url_demo'] = $errors->first('url_demo');
            }

            if($errors->has('price')){
                $err['messages']['price'] = $errors->first('price');
            }

            if($errors->has('uploadimage')){
                $err['messages']['uploadimage'] = $errors->first('uploadimage');
            }

   
            return response()->json($err);
        }

        $img = $request->file('uploadimage');
       
        $nameImg = str_slug($request['name']).'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();
        
        $img->move($this->UploadFolder, $nameImg);
       

        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'summary' => $request['summary'],
            'url_demo' =>$request['url_demo'],
            'price' => trim($request['price']),
            'file' => $nameImg,
            'status' => ($request['status'] == 'true' ) ? 'Y' : 'N',
            'created_at' => date('Y-m-d H:i:s'),
            
            
        ];  

        $save = Themes::create($data);
        if($save->id){
             $this->clearCache();

           
            return response()->json(['id'=>$save->id]);
        }   
    }

    public function search(Request $request)
    {
        
        $_tempResult = Themes::filter($request->all())->orderby('_id', 'desc')->Paginate($this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);
    }



    public function active($id='', $status='N')
    {
        
        $dataPost['status'] = $status;
        $__temp_ = Themes::where("_id",$id)->update(['status'=>$status]);
        
        $results['data'] = $__temp_;
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
            $__temp_[$key]['name'] = $val['name'];
            $__temp_[$key]['price'] = $val['price'];
            $__temp_[$key]['summary'] = $val['summary'];
            $__temp_[$key]['url_demo'] = $val['url_demo'];
            $__temp_[$key]['description'] = $val['description'];
            $__temp_[$key]['file'] = $val['file'];
            
            $url_media = getenv('MEDIA_URL').'/images/themes/'.$val['file'];
            $__temp_[$key]['imageurl'] = !empty($val['file']) ? $url_media : url('/images/not-found.png');
            $__temp_[$key]['status'] = $val['status'];
            $__temp_[$key]['created_at'] = $val['created_at'];
             // $__temp_[$key]['position'] = $val['position'];
           
        }
       
        $results['data'] = $__temp_;
        $results['total'] = $data->total();
        $results['lastPage'] = $data->lastPage();
        $results['perPage'] = $data->perPage();
        $results['currentPage'] = $data->currentPage();
        $results['nextPageUrl'] = $data->nextPageUrl();

        return $results;

    }

    public function delete($id)
    {
        $messages['messages'] = false;
        $_res = Themes::find($id);
    
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }else{
            if(file_exists($this->UploadFolder.$_res['file'])) {
                File::delete($this->UploadFolder.$_res['file']);
            }

           
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
