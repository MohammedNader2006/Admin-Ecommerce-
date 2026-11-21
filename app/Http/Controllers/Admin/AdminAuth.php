<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminAuth extends Controller
{
   public function login(){

   return view('admin.login');
   }

   public function dologin(){
    $rememberme= request('rememberme')==1 ? true:false;

        if(admin()->attempt(['email'=>request('email'),'password'=>request('password')], $rememberme ))
        {
            return redirect('admin');
        }
        else{
            session()->flash('erorr','Email or password incorrect ');
            return redirect(aurl('login'));
        }

   }
   public function logout(){
    auth()->guard('admin')->logout();
    return redirect(aurl('login'));
   }

   public function forgot_password(){
    return view('admin.forgot_password');
   }

   public function forgot_password_post(){
        $admin= Admin::where('email',request('email'))->first();
        if (!empty($admin)){
            $token=app('auth.password.broker')->createToken($admin);
            // $data=DB::table('password_reset_tokens')->insert([
                 // 'email'=>$admin->email,
            //     'token'=>$token,
            //     'created_at'=>Carbon::now(),
            //     ]);
           Mail::to($admin->email)->send(new AdminResetPassword(['token' => $token,'email' => $admin->email,'name'=>$admin->name]));
           session()->flash('success', trans('Reset Link is Sent'));
           return back();
        }
        return back();
   }



public function reset_password($token)
{
    $record = DB::table('password_reset_tokens')
        ->where('created_at', '>', Carbon::now()->subHours(2))
        ->get()
        ->first(fn($row) => Hash::check($token, $row->token));

    if (!empty($record)) {
            return view('admin.reset_password',['data'=>$record]);
    }
    else
            return redirect(aurl('forgot/password'))->with('erorr', 'Token invalid or expired');

}

public function reset_password_final($token)
{
    $validator = Validator::make(request()->all(), [
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $record = DB::table('password_reset_tokens')
        ->where('created_at', '>', Carbon::now()->subHours(2))
        ->get()
        ->first(fn($row) => Hash::check($token, $row->token));

    if (!empty($record)) {
       $admin= Admin::where('email', $record->email)
            ->update([
                'email' => $record->email,
                'password' => bcrypt(request('password')),
            ]);
            // DB::table('password_reset_tokens')->where('email',request('email'))->delete();

        return redirect(aurl().'/login');
    }
    else {
        return redirect(aurl('forgot/password'));
    }
}
}
