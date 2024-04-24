<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AuthController extends Controller
{
    public function signUp(){
        return view ('auth.sign-up');
    }

    public function authRegister(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);

        return redirect()->route('signIn')->with('success', 'Regist berhasil, silahkan login!');
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
                return redirect()->route('user.books');
            }
        }else{
            return redirect()->back()->with('danger', "Gagal login, silahkan cek kembali!");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/signIn');
    }
}
