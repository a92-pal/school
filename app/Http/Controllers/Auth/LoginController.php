<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
// use Illuminate\Validation\ValidationException;

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
    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    // protected function sendFailedLoginResponse(Request $request)
    // {
    //     throw ValidationException::withMessages([
    //         'login' => [trans('auth.failed')],
    //     ]);
    // }

    /** 
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    
    public function login(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ]);
        
        if(is_numeric($request->input('login')))
        {
            $login_type='phone';
        }
        elseif(filter_var($request->input('login'), FILTER_VALIDATE_EMAIL ))
        {
            $login_type='email';
        }
        else{
            $login_type='reg_no';
        }
        $request->merge([
            $login_type => $request->input('login')
        ]);
        // dd($login_type);
        // dd($request->all());

        if (Auth::attempt($request->only($login_type, 'password'))) {
            return redirect()->intended($this->redirectPath());
        }

        return redirect()->back()
            ->withInput()
            ->withErrors([
                'login' => 'These credentials do not match our records.',
            ]);
    } 

  
}
