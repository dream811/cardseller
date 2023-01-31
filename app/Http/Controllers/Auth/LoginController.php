<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Custom code for Auth process
    protected function credentials( Request $request )
    {
        $credentials = $request->only($this->username(), 'password');

        $credentials['is_use'] = 1;

        return $credentials;

    }

    protected function sendFailedLoginResponse(Request $request)
    {
          
        throw ValidationException::withMessages([
            // $this->username() => [trans('auth.falied')],
            $this->username() => [trans('auth.failed')],
        ]);
        
    }

    // /**
    //  * Write code on Method
    //  *
    //  * @return response()
    //  */
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);
     
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
  
    //         return redirect()->route('home');
    //     }
    
    //     return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    // }

    protected function authenticated(Request $request, $user)
    {
        if ( $user->isAdmin() ) {// do your magic here
            return redirect()->route('admin.user.list');
        }

        return redirect('/notice');
    }

    public function username(){
        return 'str_id';
    }
}
