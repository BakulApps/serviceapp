<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->data['setting'] = new Setting();
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')){
            return $this->authentication($request);
        }
        else {
            $this->data['title'] = 'Masuk Administrator';
            return view('fronted.login', $this->data);
        }
    }

    public function authentication(Request $request)
    {
        $credentials = ['user_name' => $request->user_name, 'password' => $request->user_pass];
        if (Auth::guard('admin')->attempt($credentials, $request->remember)){
            return redirect()->route('admin.home');
        }
        else {
            return redirect()->back()->withInput()->with('msg', ['class' => 'danger', 'text' => 'Nama Pengguna dan Kata Sandi tidak tepat']);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login')->with('msg', ['class' => 'success',  'text' => 'Anda berhasil keluar']);
    }
}
