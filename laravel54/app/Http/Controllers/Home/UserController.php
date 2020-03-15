<?php

namespace App\Http\Controllers\Home;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    //
    public function getReset()
	{
	    return view('auth.reset');
	}

	public function postReset(Request $request)
	{
		$oldpassword = $request->input('oldpassword');
		$password = $request->input('password');
		$data = $request->all();
		$rules = [
			'oldpassword'=>'required|between:6,20',
			'password'=>'required|between:6,20|confirmed',
		];
		$messages = [
			'required' => '密码不能为空',
			'between' => '密码必须是6~20位之间',
			'confirmed' => '新密码和确认密码不匹配'
		];
		$validator = Validator::make($data, $rules, $messages);
		$user = Auth::user();
		$validator->after(function($validator) use ($oldpassword, $user) {
			if (!\Hash::check($oldpassword, $user->password)) {
				$validator->errors()->add('oldpassword', '原密码错误');
			}
		});
		if ($validator->fails()) {
			return back()->withErrors($validator);  //返回一次性错误
		}
		$user->password = bcrypt($password);
		$user->save();
		Auth::logout();  //更改完这次密码后，退出这个用户
		return redirect('/login');
	}
}
