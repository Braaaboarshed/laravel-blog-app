<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // عرض صفحة التسجيل
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // معالجة التسجيل
    public function register(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false
        ]);

        // تسجيل الدخول بعد التسجيل مباشرة
        Auth::login($user);

        return redirect()->route('home'); // أو أي صفحة تريد توجيه المستخدم إليها
    }

    // عرض صفحة تسجيل الدخول
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // معالجة تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('posts'); // إعادة توجيه للمسار المطلوب
        }

        return redirect()->back()->withErrors(['email' => 'هذه بيانات تسجيل الدخول غير صحيحة']);
    }

    // تسجيل الخروج
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
