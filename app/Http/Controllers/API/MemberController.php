<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\AppBaseController;
use JWTAuth;
use App\Models\User;
use JWTAuthException;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Helpers\GeneralHelpers;

class MemberController extends AppBaseController
{   
    private $userRepository;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->Cfg = config();
        $this->perPage = $this->Cfg['general']['limitData'];
        
    }

   

    public function active($id='', $active='N')
    {
        
        $dataPost['status'] = $active;
        $__temp_ = $this->userRepository->update($dataPost, $id);
        
        $results['data'] = $__temp_;
        return response()->json($results);
    }

    public function lists(Request $request)
    {
        $type ='admin';
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $_tempResult = $this->userRepository->getWithLimit($this->perPage,$type);
        $results = $this->__build($_tempResult, $request);
        return response()->json($results);
    }

    public function search(Request $request)
    {
        
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $_tempResult = $this->userRepository->getSearch($request->all(), $this->perPage);
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
            $__temp_[$key]['phone'] = $val['phone'];
            $__temp_[$key]['address'] = $val['address'];
            if($val['status'] ==1){ $status ="Aktif"; }else{ $status ="Non Aktif";}
            $__temp_[$key]['status'] = $status;
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

    public function post(CreateUserRequest $request)
    {

        $fields = [
            'name'  => 'Name',
            'phone'  => 'Phone',
            'address' =>'Address',
            'type' =>'Type',
            'password'  => 'Password',
            'password_confirmation'  => 'Password Confirmation',
            

        ];

        $validator =  Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|max:8|min:4|confirmed',
            'password_confirmation' => 'required|max:8|min:4|same:password',
        ]);
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();
            
          
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

             if($errors->has('phone')){
                $err['messages']['phone'] = $errors->first('phone');
            }

             if($errors->has('type')){
                $err['messages']['type'] = $errors->first('type');
            }

            if($errors->has('address')){
                $err['messages']['address'] = $errors->first('address');
            }

            if($errors->has('status')){
                $err['messages']['status'] = $errors->first('status');
            }

            if($errors->has('password')){
                $err['messages']['password'] = $errors->first('password');
            }

            if($errors->has('password_confirmation')){
                $err['messages']['password_confirmation'] = $errors->first('password_confirmation');
            }
            
            return response()->json($err);

        }

        $data = [
           
            'name' => trim($request['name']),
            'phone' => trim($request['phone']),
            'type' => trim($request['type']),
            'address' => trim($request['address']),
            'password' => Hash::make(trim($request['password'])),
            'status' => ($request['status'] == 1) ? 1 : 0,
        ];  

        // return response()->json(['id'=>1]);
        $save = $this->userRepository->create($data);
        if($save->id){
            return response()->json(['id'=>$save->id]);
        }   

    }

    public function editUser($id)
    {
        $checked = "";
        $results = array();
        $user = $this->userRepository->findWithoutFail($id);
        if(empty($user)){
            return response()->json(['messages' => false]);
        }

        $results['id'] = $user->id;
        $results['name'] = $user['name'];
    
        $results['status'] = $user['status'];
       
        return response()->json($results);

    }

    public function updateUser($id, UpdateUserRequest $request){
        
        $err = array();
        $fields = [
           
        
            'password'  => 'Password',
            'password_confirmation'  => 'Password Confirmation',
            'name'  => 'Name',

        ];

        $validator =  Validator::make($request->all(), [
            
            'name' => 'required|max:8|min:4',
            'password' => 'nullable|max:8|min:4|confirmed',
            'password_confirmation' => 'nullable|max:8|min:4|same:password',
        ]);
        
        $validator->setAttributeNames($fields); 
        if ($validator->fails()) {
            
            $errors = $validator->errors();
            
           
            if($errors->has('name')){
                $err['messages']['name'] = $errors->first('name');
            }

          

            if($errors->has('password') && !empty($request->has('password')) ){
                $err['messages']['password'] = $errors->first('password');
            }

            if($errors->has('password_confirmation') && !empty($request->has('password_confirmation')) ){
                $err['messages']['password_confirmation'] = $errors->first('password_confirmation');
            }
            
            return response()->json($err);

        }
        $pass = array();
        if($request->has('password') && !empty($request->has('password'))){
            $pass = ['password' => Hash::make(trim($request['password']))];
        }

        $data = [
      
            'name' => trim($request['name']),
            'status' => ($request['status'] == 1) ? 'Y' : 'N',
        ];  

        $data = array_merge($pass,$data);
        $save = $this->userRepository->update($data, $id);
        if($save->id){
            return response()->json(['id'=>$save->id]);
        }   


    }

    public function deleteUser($id)
    {
        $messages['messages'] = false;
        $user = $this->userRepository->findWithoutFail($id);
        if(empty($user)){
            return response()->json(['messages' => false]);
        }

        $results = $this->userRepository->delete($id);
        if($results){
            $messages['messages'] = true;
        }
        return response()->json($messages);
    }

    
}  