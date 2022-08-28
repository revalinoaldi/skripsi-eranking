<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $forheader = [];

    public function index()
    {
        $config = [
            'title' => 'System Login'
        ];
        return view('login.index', $config);
    }

    public function auth(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|string|min:4|email:dns',
            'password' => 'required|min:4'
        ]);

        $remember = $request->has('remember_me') ? true : false;

        if (Auth::attempt($credential, $remember)) {
            $request->session()->regenerate();

            if (auth()->user()->level->slug == 'admin-tu') {
                return redirect()->intended('/admin/dashboard');
            }elseif(auth()->user()->level->slug == 'guru'){
                return redirect()->intended('/guru/dashboard');
            }else{
                return redirect()->intended('/');
            }
        }

        return back()->with('notif', '
        <div class="alert alert-danger alert-dismissible fade show" role="alert"><strong><i class="icon fa fa-ban"></i> Error Login!</strong> <br>Email or Password incorrect, please try again!
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close" data-bs-original-title="" title=""></button>
        </div>');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
