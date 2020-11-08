<?php
namespace App\Http\Controllers\API;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Helpers\GeneralHelpers;
use Illuminate\Support\Facades\Validator;

class ContactController extends AppBaseController
{   
    private $Contact;
    public function __construct()
    {
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
        
    }

    public function lists(Request $request)
    {
       	$_tempResult = Contact::orderby('id', 'desc')->Paginate($this->perPage);
		$results = $this->__build($_tempResult, $request);
		return response()->json($results);

    }

     public function active($id='', $active='N')
    {
        
        $dataPost['status'] = $active;
        $__temp_ = Contact::where("_id",$id)->update($dataPost);
        
        $results['data'] = $__temp_;
        return response()->json($results);
    }

    public function edit($id)
    {
        $checked = "";
        $results = array();
        $_res = Contact::find($id);
        if(empty($_res)){
            return response()->json(['messages' => false]);
        }

        $results['id'] = $_res->id;
        $results['name'] = $_res['name'];
        $results['status'] = $_res['status'];
       
        return response()->json($results);

    }

    public function update($id, Request $request){
        
       $err = array();
        $fields = [
            'name' => 'Name',
            'status'=>'Status',
        ];

        
        
        
        $validator =  Validator::make($request->all(), array_merge([
            'name' => 'required|max:255',
            'status' => 'required|max:100',
        ],$validationImg));
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();

            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('status')){
                $err['messages']['status'] = $errors->first('status');
            }

           

            return response()->json($err);
        }

           
        
       
        $data = [
            'name' => $request['name'],          
            'status' => ($request['status'] == 'true' ) ? 'Y' : 'N',
            'updated_at' => date('Y-m-d H:i:s'),
        ]; 

      
        
        $save = Contact::where("_id",$id)->update($data);
        $saveId = $save;
        if($saveId){
            
            return response()->json(['id'=>$saveId]);
        }   
    }

    public function post(Request $request)
    {

        $fields = [
            'name'      => 'Name',
           
        ];

        $validator =  Validator::make($request->all(), [
            'name' => 'required|max:255',
           
        ]);
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();
            
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

            if($errors->has('status')){
                $err['messages']['status'] = $errors->first('status');
            }

            return response()->json($err);
        }

        $data = [
            'name' => $request['name'],
            'status' => ($request['status'] == 'true' ) ? 'Y' : 'N',
            'created_at' => date('Y-m-d H:i:s'),
        ];  

        $save = Contact::create($data);
        if($save->id){
           
            return response()->json(['id'=>$save->id]);
        }   
    }

    public function search(Request $request)
    {
        
        $_tempResult = Contact::filter($request->all())->orderby('_id', 'desc')->Paginate($this->perPage);
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
            $__temp_[$key]['name'] = $val['name'];
            $__temp_[$key]['status'] = $val['status'];
            // $created_at = (string) $val['created_at'];
            // $__temp_[$key]['created_at'] = GeneralHelpers::tanggal_indo($created_at);
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
        $_res = Contact::find($id);
          
        

        $results = $_res->delete();

        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }



}

?>
