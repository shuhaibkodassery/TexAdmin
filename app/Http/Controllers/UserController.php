<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use DB;
use Redirect;
use Session;
use View;
use Log;

class UserController extends Controller
{
    /**
     * @author Shuhaib Malik
     * On 28 December 2023
     */
    public $successStatus = 200;

    public function loginUsers(Request $request)
    { 
        $validate = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required',
        ]);
        if($validate->fails()) {
            return redirect()->back()->with('error', 'Username or password is empty');
        }
        $input = ['email' => request('email'), 'password' => request('password')];
        $remember_token = $request->has('rememberMe') ? true : false;
        if(auth()->attempt($input,$remember_token)){
            return redirect('/dashboard');
        }else {
            return redirect('/')->with('error', 'Invalid username or password');
        }
        
    }

    public function deleteAllSession(){

        auth()->logout();
        return redirect('/');
    }
}
