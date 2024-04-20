<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signUp(){
        return view ('auth.sign-up');
    }

    public function registerStore(Request $request)
    {

    }

    public function signIn(){
        return view ('auth.sign-in');
    }

    public function authLogin(Request $request)
    {
        $user = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($user)) {
            if(Auth::user()->role == 'admin'){
                return redirect()->route('admin');
            }elseif(Auth::user()->role == 'staff'){
                return redirect()->route('staff');
            }else{
                return redirect()->route('user');
            }
        }else{
            return redirect()->back()->with('danger', "Gagal login, silahkan cek kembali!");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect ('/login-page')->with('success', 'Logged out successfully');
    }
}
