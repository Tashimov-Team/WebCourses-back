<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use App\Models\Course;
use App\Models\Curriculum;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($request->email === config('services.admin.email') &&
            $request->password === config('services.admin.password')) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.courses.index');
        }

        return back()->withErrors(['credentials' => 'Неверные учетные данные']);
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('login');
    }
}
