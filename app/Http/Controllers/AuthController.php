<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return redirect('/login')
            ->with('success', 'Đăng ký tài khoản thành công');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            session([
                'isLogin' => true,
                'username' => $user->username,
                'name' => $user->name,
                'user_id' => $user->id
            ]);

            return redirect('/dashboard');
        }

        return redirect('/login')
            ->with('error', 'Sai tên đăng nhập hoặc mật khẩu');
    }

    public function dashboard()
    {
        if (!session('isLogin')) {
            return redirect('/login');
        }

        return view('dashboard');
    }

    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }
}