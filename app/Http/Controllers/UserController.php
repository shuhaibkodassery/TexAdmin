<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Users;
use DB;
use Redirect;
use Session;
use View;

class UserController extends Controller
{
    /**
     * @author Shuhaib Malik
     * On 28 December 2023
     */
    public $successStatus = 200;
    public function loginUsers(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'user_name' => 'required',
                'user_pwd' => 'required',
            ]);

            if ($validator->fails()) {
                return Redirect::back()->with('error', 'User Name or Password Required');
            }
            $user_name = $request->input('user_name');
            $user_pwd = $request->input('user_pwd');
    
            $login = Users::where('user_name', $user_name)->where('user_pwd', $user_pwd)->first();

            DB::commit();
            if ($login) {
                if (session()->has('activeUser')) {
                    Session::forget('activeUser');
                }
                $activeUser = array();
                $data = new Users;
                $data->user_id = $login->user_id;
                $data->user_name = $login->user_name;
                $data->user_pwd = $login->user_pwd;
                $activeUser[] = $data;

                Session::put('activeUser', $activeUser);


                return Redirect("/dashboard");
            } else {
                return redirect()->back()->with('error', 'Incorrect Username or Password');
            }

        } catch (\Exception$e) {
            DB::rollback();
            Log::error($e);
            return Redirect::back()->with('error', 'IT WORKS!');
        }
    }
    public function deleteAllSession(){

        Session::forget('activeUser');

        return View::make("Admin.login");
    }
}
