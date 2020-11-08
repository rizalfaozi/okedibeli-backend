<?php
namespace App\Http\Controllers\API;
use App\Models\Fiture;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Facades\Validator;
use File;

class FitureController extends AppBaseController
{   
    private $Fiture;
    public function __construct()
    {
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
        $this->UploadFolder = $this->Cfg['general']['uploadFitureFolder'];
        $this->domain = $this->Cfg['general']['domain'];
    }

    public function lists(Request $request)
    {
        $_tempResult = Fiture::orderby('created_at', 'desc')->Paginate($this->perPage);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);

    }

     public function active($id='', $active='N')
    {
        
        $dataPost['status'] = $active;
        $__temp_ = Fiture::where("_id",$id)->update($dataPost);
        
        $results['data'] = $__temp_;
        return response()->json($results);
    }

    public function edit($id)
    {
        $checked = "";
        $results = array();
        $_res = Fiture::find($id);
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results['id'] = $_res->id;
        $results['title'] = $_res['title'];
        $results['description'] = $_res['description'];
      
  
        $results['file'] = $_res['file'];
        $url_media = getenv('MEDIA_URL').'/fiture/'.$_res['file'];
            $results['imageurl'] = !empty($_res['file']) ? $url_media : url('/images/not-found.png');
        $results['status'] = $_res['status'];
       
        return response()->json($results);

    }

    public function update($id, Request $request){

        $err = array();
        $fields = [
            'title' => 'Title',
            'description'  => 'Description',
            'uploadimage'  => 'Upload Image',
        ];

        $validationImg = array();
        
        if ($request->hasFile('uploadimage')){
            $validationImg['uploadimage'] = "required|mimes:jpg,jpeg,png,gif";
        }
        
        $validator =  Validator::make($request->all(), array_merge([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|max:100',
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

            if($errors->has('uploadimage')){
                $err['messages']['uploadimage'] = $errors->first('uploadimage');
            }

            return response()->json($err);
        }
        
        if ($request->hasFile('uploadimage'))
        {
            $_res = Fiture::find($id);
            File::delete($this->UploadFolder.$_res['file']);
            $img = $request->file('uploadimage');
            $nameImg = str_slug($request['title']).'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();
            $img->move($this->UploadFolder, $nameImg);
           

            $arr['file'] = $nameImg;
        }

        $data = [
            'title' => $request['title'],
            'description' => $request['description'],
          
            'status' => ($request['status'] == 'true' ) ? 'Y' : 'N',
            'updated_at' => date('Y-m-d H:i:s'),
        ]; 

        $data = isset($nameImg) ? array_merge($data, $arr) : $data;
        
        $save = Fiture::where("_id",$id)->update($data);
        $saveId = $save;
        if($saveId){
          
            
            
            return response()->json(['id'=>$saveId]);
        }   
    }

    public function store(Request $request)
    {
       
        $fields = [
            'title' => 'Title',
            'description'  => 'Description',
            'uploadimage'  => 'Upload Image',
            'status' =>'Status',
        ];

        $validator =  Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'required',
            'uploadimage' => 'required|mimes:jpeg,jpg,png,gif',
            'status' =>'required',
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

            if($errors->has('status')){
                $err['messages']['status'] = $errors->first('status');
            }


            if($errors->has('uploadimage')){
                $err['messages']['uploadimage'] = $errors->first('uploadimage');
            }

            return response()->json($err);
        }

        $img = $request->file('uploadimage');
        $nameImg = str_slug($request['title']).'-'.date('YmdHis').'.'.$img->getClientOriginalExtension();
        $img->move($this->UploadFolder, $nameImg);

        $data = [
            'title' => $request['title'],
            'description' => $request['description'],
            'file' => $nameImg,
            'status' => ($request['status'] == 'true' ) ? 'Y' : 'N',
            'created_at' => date('Y-m-d H:i:s'),
        ];  

        $save = Fiture::create($data);
        if($save->id){
            return response()->json(['id'=>$save->id]);
        }  
    }

    public function search(Request $request)
    {
        
        $_tempResult = Fiture::filter($request->all())->orderby('_id', 'desc')->Paginate($this->perPage);
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
            $__temp_[$key]['title'] = $val['title'];
            $__temp_[$key]['description'] = $val['description'];
         
            $__temp_[$key]['file'] = $val['file'];
            $url_media = getenv('MEDIA_URL').'/images/fiture/'.$val['file'];
            $__temp_[$key]['imageurl'] = !empty($val['file']) ? $url_media : url('/images/not-found.png');
            $__temp_[$key]['status'] = $val['status'];
            $__temp_[$key]['created_at'] = $val['created_at'];
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
        $_res = Fiture::find($id);
          
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