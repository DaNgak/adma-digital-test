<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view("login.index", [
            "title" => "Login",
        ]);
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|unique:users|min:4|max:15',
            'phone' => 'required|numeric|min_digits:10|max_digits:15|unique:users',
            'email' => 'required|email|unique:users',
            'password' =>  'required|confirmed|min:6',
        ]);

        $credentials['password'] = Hash::make($request->password);

        User::insert($credentials);
        return back()->with("success", "Register sukses, silahkan login !");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);
        if (Auth::attempt($credentials)) {

            if(!in_array(Auth::user()->role, ["user", "admin"])){
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->with("loginError", "Login gagal, credential salah !");
            };
            $request->session()->regenerate();
            return redirect()->intended("/dashboard");
        }
        return back()->with("loginError", "Login gagal, credential salah !");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/login");
    }
}
