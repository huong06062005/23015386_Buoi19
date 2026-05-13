<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // Quan trọng: Phải có dòng này để gọi Controller

// Trang chủ
Route::get('/', function () {
    return view('home');
});

// Trang đăng nhập (Hiển thị form)
Route::get('/login', [AuthController::class, 'showLogin']);

// Xử lý dữ liệu khi bấm nút Login (Phương thức POST)
Route::post('/login', [AuthController::class, 'login']);

// Trang Dashboard (Chỉ vào được khi đã đăng nhập)
Route::get('/dashboard', [AuthController::class, 'dashboard']);

// Đăng xuất
Route::get('/logout', [AuthController::class, 'logout']);