<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        // Kiểm tra thông tin cố định
        if ($username == 'admin' && $password == '123456') {
            // Nếu đúng: Lưu trạng thái vào Session
            session([
                'isLogin' => true,
                'username' => $username
            ]);
            return redirect('/dashboard');
        }

        // Nếu sai: Quay lại trang login kèm thông báo lỗi
        return redirect('/login')->with('error', 'Sai tên đăng nhập hoặc mật khẩu');
    }

    public function dashboard()
    {
        // Kiểm tra nếu chưa đăng nhập thì không cho xem dashboard
        if (!session('isLogin')) {
            return redirect('/login');
        }
        return view('dashboard');
    }

    public function logout()
    {
        // Xóa sạch session và về trang login
        session()->flush();
        return redirect('/login');
    }
}