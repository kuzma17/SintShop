<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function username()
    {
        return 'phone';
    }

    public function loginOrder(Request $request){

        $request['phone'] = cleanPhone($request['phone']);

        $this->validateLogin($request);

//        $phone = cleanPhone($request->phone);
//        $password = $request->password;
//        if(Auth::attempt(['phone' => $phone, 'password' => $password])){
//            return redirect()->back();
//        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return json_encode([
                'user' => auth()->user()
            ]);

        }

        return $this->sendFailedLoginResponse($request);
    }

//    public function loginPhone(Request $request)
//    {
//        $request['phone'] = cleanPhone($request['phone']);

//        if ($request->ajax()){
//
//            if($this->login($request)){
//                return json_encode([
//                    'user' => auth()->user()
//                ]);
//            }
//
//        }

//        return $this->login($request);
//    }
}
