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

  public function login(Request $request)
  {

    return redirect()->intended(route('dashboard-analytics'));

    echo "<pre>";
    print_r($request->all());
    die;

    $request->validate([
      'email'     => 'required|string', // can be email or username
      'password'  => 'required|string',
    ]);

    echo "here";
    die;


    $loginField = $request->input('email');

    // check if input is an email or username
    $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    $credentials = [
      $fieldType => $loginField,
      'password' => $request->input('password'),
    ];
    print_r($credentials);
    die;


    if (Auth::attempt($credentials, $request->filled('remember'))) {
      $request->session()->regenerate();
      return redirect()->intended(route('dashboard-analytics'));
    }

    return back()->withErrors([
      'email' => 'Invalid credentials.',
    ])->withInput();
  }


  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
  }
}
