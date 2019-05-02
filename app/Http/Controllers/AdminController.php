<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('backEnd.index');
    }
    public function settings(){
        return view('backEnd.setting');
    }
    public function updatAdminPwd(Request $request){
        $request->validate([
            'pwd_current'=>'required',
            'pwd_new'=>'required',
            'pwdnew_confirm'=>'required'
        ]);
        $data=$request->all();
        $current_password=$data['pwd_current'];
        $email_login=Auth::user()->email;
        $check_password=User::where(['email'=>$email_login])->first();
        if(Hash::check($current_password,$check_password->password)){
            if ($data['pwd_new'] === $data['pwdnew_confirm']){
                $password=bcrypt($data['pwd_new']);
                User::where('email',$email_login)->update(['password'=>$password]);
                return redirect('/admin/settings')->with('success','Password Update Successfully');
            }else{
                return redirect('/admin/settings')->with('error','Passwords doesnt match!');
            }
        }else{
            return redirect('/admin/settings')->with('error','InCorrect Current Password');
        }
    }
}
