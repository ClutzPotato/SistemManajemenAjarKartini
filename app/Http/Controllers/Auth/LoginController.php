<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/homelogin';

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

    public function redirectTo()
    {
        // Redirect user based on role
        if (Auth::check() && Auth::user()->role == 'student') {
            return '/student/dashboard';
        } elseif (Auth::check() && Auth::user()->role == 'teacher') {
            return '/teacher/dashboard';
        } elseif (Auth::check() && Auth::user()->role == 'admin') {
            return '/admin/dashboard';
        }
        else {
            return '/';
        }
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role == 'student') {
            return redirect('/student/dashboard');
        } elseif ($user->role == 'teacher') {
            return redirect('/teacher/dashboard');
        } elseif ($user->role == 'admin') {
            return redirect('/admin/dashboard');
        }
    }
    
    public function loginstudent(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if (Auth::user()->role == 'student') {
                return $this->sendLoginResponse($request);
            } else {
                Auth::logout();
                return $this->sendFailedLoginResponse($request, 'Please make sure you are logging in to a student account');
            }
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function loginteacher(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            if (Auth::user()->role == 'teacher'||Auth::user()->role == 'admin') {
                return $this->sendLoginResponse($request);
            } else {
                Auth::logout();
                return $this->sendFailedLoginResponse($request, 'Please make sure you are logging in to a teacher or admin account');
            }
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request, $message = 'auth.failed')
    {
        throw ValidationException::withMessages([
            $this->username() => [trans($message)],
        ]);
    }
}
