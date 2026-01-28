<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function login(\Illuminate\Http\Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $login = $request->input($this->username());
        
        // Check if $login is email or name
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        
        $user = \App\Models\User::where($field, $login)->first();

        if ($user && \Hash::check($request->password, $user->password)) {
            if (!$user->is_active) {
                return $this->sendFailedLoginResponse($request);
            }
            
            auth()->login($user, $request->filled('remember'));
            return $this->authenticated($request, $user);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected $redirectTo = '/dashboard';

    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        if (!$user->is_active) {
            auth()->logout();
            return back()->withErrors([
                $this->username() => 'Your account has been disabled. Please contact support.',
            ]);
        }
        
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->intended($this->redirectTo);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
