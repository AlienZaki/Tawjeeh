<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
class AuthController extends Controller
{
    public $successStatus = 200;

    public function signup(Request $request) {
        $stages = array('s1', 's2', 's3', 's4');
        $types = array('web', 'mobile');

        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'type' => 'required|in:'.implode(',', $types),
        ];
        if ($request['type'] == 'mobile'){
            $rules['stage'] = 'required|in:'.implode(',', $stages);
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'data'=>$validator->errors()], 401);                        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  'Bearer '.$user->createToken('AppName')->accessToken;
        return response()->json(['success'=>true,'data'=>$success], 200);
    }


    public function login(Request $request){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $host = $request->getHttpHost();
            $user = Auth::user();
            $res['username'] = $user['email'];
            $res['name'] = $user['name'];
            $res['photo'] = 'http://'.$host.'/photos/'.$user['photo'];
            $res['stage'] = $user['stage'];
            $res['token'] =  'Bearer '.$user->createToken('AppName')-> accessToken;
            return response()->json(['success'=>true,'data' => $res], 200);
        } else{
            return response()->json(['success'=>false,'message'=>'Invalid login'], 401);
        }
    }

    public function getUser() {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
