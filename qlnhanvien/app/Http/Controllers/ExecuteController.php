<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Validator;

class ExecuteController extends Controller
{
    public function postLogin(Request $request)
    {
        $data=[
            'username'=>$request->input('username'),
            'password'=>$request->input('password')
        ];
            if(Auth::attempt($data)){
              return \Redirect::to('/employee');
        } else {
            return \Redirect::to('/login');
        }
    }

    public function getSignOut() {
        Auth::logout();
        return \Redirect::to('/login');
    }
    public function index(){
    	$quyen=Auth::id();
        $taikhoan=User::where('id',$quyen)->get();
        return view('home',compact('taikhoan'));

    }
    public function getChangePassword(){
    	return view('auth.passwords.changePass');
    }
    public function postChangePassword(Request $request){
        //lay so lan dang nhap

    	$status=[
            'required' => 'Trường :attribute bắt buộc nhập.',
            'confirmed'    => 'Trường :attribute phải giong nhau'
        ];
    	$validator= Validator::make($request->all(),[
    		'password_old'=>'required',
    		'password_new'=>'required|required_with:password_new_confirm|same:password_new_confirm'

    	],$status);
    	  if ($validator->fails()) {
    	  	return redirect()->back() ->withErrors($validator)
                    ->withInput();
    	  }
    	  else{
             $count=(int)Auth::user()->count_login;
             $count+=1;
    	$hashPass=Auth::user()->password;
    	    	if(Hash::check($request->password_old,$hashPass))
    	{
            $user=User::find(Auth::id());
            $user->password=bcrypt($request->password_new);
            $user->count_login=$count;
    		$user->save();
    		Auth::logout();
    		return \Redirect::to('/login')->with('status','Doi mat khau thanh cong');
    	}else{
    		return redirect()->back()->with('status','sai mat khau cu');
    	}
    }
    }
}
