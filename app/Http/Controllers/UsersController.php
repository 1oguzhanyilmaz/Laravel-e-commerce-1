<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function index(){
        return view('users.login_register');
    }
    public function login(Request $request){
        $input_data = $request->all();
        if(Auth::attempt(['email'=>$input_data['email'],'password'=>$input_data['password']])){
            Session::put('loginSession',$input_data['email']);
            if (Auth::user()->isAdmin()){
                return redirect('/')->with('success','Welcome Admin !');
            }
            return redirect('/viewcart');
        }else{
            return back()->with('error','Account is not Valid!');
        }
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $input_data=$request->all();
        $input_data['password']=Hash::make($input_data['password']);
        User::create($input_data);
        return back()->with('success','Registered !');
    }
    public function logout(){
        Auth::logout();
        Session::forget('loginSession');
        return redirect('/');
    }
    public function account(){
        $countries = DB::table('countries')->get();
        $user_login = User::where('id',Auth::id())->first();
        return view('users.account',compact('countries','user_login'));
    }
    public function updateprofile(Request $request, $id){
        $request->validate([
            'address'=>'required',
            'city'=>'required',
            'mobile'=>'required|numeric'
        ]);
        $input_data = $request->all();
        DB::table('users')
            ->where('id',$id)
            ->update([
                'name'=>$input_data['name'],
                'address'=>$input_data['address'],
                'city'=>$input_data['city'],
                'country'=>$input_data['country'],
                'mobile'=>$input_data['mobile']
            ]);
        return back()->with('success','Updated successfully !');
    }
    public function updatepassword(Request $request, $id){
        $oldPassword = User::where('id',$id)->first();
        $input_data = $request->all();
        if(Hash::check($input_data['password'],$oldPassword->password)){
            $this->validate($request,[
                'newPassword'=>'required|min:6|max:12|confirmed'
            ]);
            $new_pass = Hash::make($input_data['newPassword']);
            User::where('id',$id)->update(['password'=>$new_pass]);
            return back()->with('success','Updated successfully!');
        }else{
            return back()->with('error','Password is Inconrrect!');
        }
    }

    ####################################################################
    ##### Admin Panel #####
    public function userIndex(){
        $i=0;
        $users = User::orderBy('created_at','desc')->paginate(10);
        return view('backEnd.users.index',compact('users','i'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function userCreate(){
        return view('backEnd.users.create');
    }
    public function userStore(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|unique:users,email',
            'password'=>'required|min:6|confirmed',
        ]);
        $formInput = $request->all();
        $formInput['password'] = Hash::make($formInput['password']);
        User::create($formInput);
        return redirect('/admin/users')->with('success','User added successfully!');
    }
    public function userShow($id){
        die('user Show');
    }
    public function userEdit($id){
        $edit_user = User::findOrFail($id);
        return view('backEnd.users.edit',compact('edit_user'));
    }
    public function userUpdate(Request $request, $id){
        $update_user = User::findOrFail($id);
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email',
            'password'=>'required|min:6|confirmed',
        ]);
        $formInput = $request->all();
        $new_pass = Hash::make($formInput['password']);
        $formInput['password'] = $new_pass;
        $update_user->update($formInput);
        return redirect('/admin/users')->with('success','User updated successfully!');
    }
    public function userDestroy($id){
        $delete_user = User::findOrFail($id);
        $delete_user->delete();
        return redirect('/admin/users')->with('success','User deleted successfully!');
    }
}
