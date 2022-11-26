<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard'; 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin.login');
    }

    public function adminLogin(Request $request)
    {
        Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'));
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'Credentials not match!');
        }
    }
    public function adminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function loginAsForm()
    {
        return view('auth.login-as');
    }

    public function loginAs (Request $request)
    {
        $userEmail = $request->email;

        $userAccount = User::where('email', $userEmail)->first();
         if ($userAccount) {
            Auth::login($userAccount);
            return redirect()->route('dashboard');
         }else {
            return redirect()->back()->with('error', 'Not Found');
         }
    }
}
