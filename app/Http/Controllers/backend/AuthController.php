<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //login and logout
    public function index()
    {
        return view('backend.auth.login');
    }
    public function dologin(Request $request)
    {
        $password = $request->password;
        $username = $request->username;
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $data['email'] = $username;
        } else {
            $data['username'] = $username;
        }
        $data['password'] = $password;
        if (Auth::attempt($data)) {
            return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->back()->with('error', 'Đăng nhập thất bại');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
    public function showRegisterForm()
    {
        return view('backend.auth.register');
    }

    public function register(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Tạo người dùng mới
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password); // Mã hóa mật khẩu
        $user->roles = 'user'; // Gán vai trò mặc định
        $user->status = 1; // Kích hoạt tài khoản
        $user->save();

        // Chuyển hướng đến trang đăng nhập
        return redirect()->route('admin.login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    //register for admin



}
