<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function userLogin(Request $request){
        $inputs = array(
            'email' => $request->email,
            'password' => $request->password,
        );
        $rules = array(
            'email' => 'required|email',
            'password' => 'required',
        );
        $validate = Validator::make($inputs,$rules);

        if($validate->fails()){
            return ['success' => false,
                    'result' => $validate->messages()->all()];
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return [
                    'success' => true,
                    'result' => [
                        'user' => $user
                    ]
                ];
            }else{
                return [
                    'success' => false,
                    'result' => ['incorrect password']
                ];
            }
        }else{
            return [
                'success' => false,
                'result' => ['incorrect email']
            ];
        }
        
    }

    public function createUser(Request $request){
        // return $request;
        $user = new User;
        $user_data = $user->addUser($request);

        return [
            'success' => true,
            'result' => $user_data
        ];
    }

    public function getAllUserr(){
        $all_users = User::all();
        return [
            'success' => true,
            'results' => $all_users
        ];
    }

    public function getCurrentUser($id){
        $user_data = User::find($id);
        return $user_data;
    }
}
