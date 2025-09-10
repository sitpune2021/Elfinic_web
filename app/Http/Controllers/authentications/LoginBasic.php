<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ add this

class LoginBasic extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.authentications.auth-login-basic', ['pageConfigs' => $pageConfigs]);
  }

    public function loginProcess(Request $request)
    {
      $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Determine if input is email or username
        $loginType = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $remember = $request->filled('remember');
//print_r($credentials);die;
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard/analytics');
        }

        // return back()->withErrors([
        //     'email' => 'Invalid credentials provided.',
        // ])->onlyInput('email');
    }


  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
  }
}
