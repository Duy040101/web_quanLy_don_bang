<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function index(){
       
        return view('admin_login');
    }
    public function showDashboard(){
       
        return view('admin.dashboard');
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'admin_email' => ['required', 'email'],
            'admin_password' => ['required'],
        ]);
 
        $admin = AdminModel::where('admin_email', $credentials['admin_email'])->first();
        if ($admin && \Hash::check($credentials['admin_password'], $admin->admin_password)) {
            Auth::login($admin);
            $request->session()->regenerate();
          
            return to_route('admin.index');
        }       
        return back()->withErrors([
           
            'error' => 'Mật khẩu hoặc tài khoản không đúng',
        ])->onlyInput('email');
       
    }

    public function logout(){
        Auth::logout();
        return to_route('login');
    }

    

}
