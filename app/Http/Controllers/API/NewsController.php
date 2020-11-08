<?php
namespace App\Http\Controllers\API;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Facades\Validator;
use File;
use Auth;
use App\Models\User;
class NewsController extends AppBaseController
{   
    private $News;
    public function __construct()
    {
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
        $this->UploadFolder = $this->Cfg['general']['uploadNewsFolder'];
        $this->domain = $this->Cfg['general']['domain'];
    }

    public function lists(Request $request)
    {
        $_tempResult = News::orderby('created_at', 'desc')->Paginate($this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);

    }

    public function edit($id)
    {
        $checked = "";
        $results = array();
        $_res = News::find($id);
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results['id'] = $_res->id;
        $results['title'] = $_res['title'];
        $results['description'] = $_res['description'];
 
        $results['summary'] = $_res['summary'];
        $results['file'] = $_res['file'];
        $url_media = getenv('MEDIA_URL').'/images/news/'.$_res['file'];
        $results['imageurl'] = !empty($_res['file']) ? $url_media : url('/images/not-found.png');
        $results['status'] = $_res['status'];
       
        
        return response()->json($results);

    }

    public function update($id, Request $request){

        $err = array();
        $fields = [
            'title' => 'Title',
            'description'  => 'Description',
            'summary'  => 'Summary',
            'uploadimage'  => 'Upload Image',
           
            
        ];

        $validationImg = array();
        
        if ($request->hasFile('uploadimage')){
            $validationImg['uploadimage'] = "required|mimes:jpg,jpeg,png,gif";
        }
        
        $validator =  Validator::make($request->all(), array_merge([
            'title' => 'required|max:255',
            'description' => 'required',
            'summary' => 'required',
           
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

             if($errors->has('summary')){
                $err['messages']['summary'] = $errors->first('summary');
            }

           

            if($errors->has('uploadimage')){
                $err['messages']['uploadimage'] = $errors->first('uploadimage');
            }

       

            return response()->json($err);
        }
        
        if ($request->hasFile('uploadimage'))
        {

            $_resi = News::find($id);
            File::delete($this->UploadFolder.$_resi['file']);
         
            $img = $request->file('uploadimage');
            $nameImg = str_slug($request['title']).'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();
            $img->move($this->UploadFolder, $nameImg);
            $dataImg['file'] = $nameImg;
        }

        $data = [
            'title' => $request['title'],
            'description' => $request['description'],
            'user_id' =>  Auth::user()->id,
            'summary' => $request['summary'],
            'status' => $request['status'],
            'created_at' => date('Y-m-d H:i:s'),
            
        ]; 

        $data = isset($nameImg) ? array_merge($data, $dataImg) : $data;
       
        $save = News::where("_id",$id)->update($data);
        $saveId = $save;
        if($saveId){
           

            return response()->json(['id'=>$saveId]);
        }   
    }

    public function post(Request $request)
    {
        
        //  $fields = [
        //     'Title' => 'Title',
        //     'description'  => 'Description',
        //     'summary'  => 'Summary',
        //     'uploadimage'  => 'Upload Image',
           
            
        // ];

        // $validator =  Validator::make($request->all(), [
        //     'title' => 'required|max:255',
        //     'summary' => 'required',
        //     'description' => 'required',
        //     'uploadimage' => 'required|mimes:jpeg,jpg,png,gif',
          
        // ]);


        
        // $validator->setAttributeNames($fields); 
        // if ($validator->fails()) {
            
        //     $errors = $validator->errors();

        //     if($errors->has('title')){
        //         $err['messages']['title'] = $errors->first('title');
        //     }

        //     if($errors->has('description')){
        //         $err['messages']['description'] = $errors->first('description');
        //     }

        //     if($errors->has('summary')){
        //         $err['messages']['summary'] = $errors->first('summary');
        //     }


        //     if($errors->has('uploadimage')){
        //         $err['messages']['uploadimage'] = $errors->first('uploadimage');
        //     }

   
        //     return response()->json($err);
        // }

        // $img = $request->file('uploadimage');
       
        // $nameImg = str_slug($request['title']).'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();
        
        // $img->move($this->UploadFolder, $nameImg);
       

        // $data = [
        //     'title' => $request['title'],
        //     'description' => $request['description'],
        //     'summary' => $request['summary'],
        //     'user_id' => Auth::user()->id,
        //     'file' => $nameImg,
        //     'status' => $request['status'],
        //     'created_at' => date('Y-m-d H:i:s'),
            
            
        // ];  

        // $save = News::create($data);
        // if($save->id){
             

           
        //     return response()->json(['id'=>$save->id]);
        // } 
           $user = Auth::user();
          return response()->json($user);  
    }

    public function search(Request $request)
    {
        
        $_tempResult = News::filter($request->all())->orderby('_id', 'desc')->Paginate($this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);
    }



    public function active($id='', $status='N')
    {
        
        $dataPost['status'] = $status;
        $__temp_ = News::where("_id",$id)->update(['status'=>$status]);
        
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
            $__temp_[$key]['title'] = $val['title'];
          
            $__temp_[$key]['summary'] = $val['summary'];
          
            $__temp_[$key]['description'] = $val['description'];
            $__temp_[$key]['file'] = $val['file'];
            
            $url_media = getenv('MEDIA_URL').'/images/news/'.$val['file'];
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
        $_res = News::find($id);
    
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

    

    

}

?>
