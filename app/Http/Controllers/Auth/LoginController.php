<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
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

    public function login(Request $request)
    {
        // Establecer la conexión para el inicio de sesión
        config(['database.default' => env('DB_CONNECTION_LOGIN')]);

        $credentials = $request->only('user', 'password');
        
        $user = User::where('abrevia', $credentials['user'])
            ->whereRaw('pwdcompare(?, clavencrypt) = 1', [$credentials['password']])
            ->first();
        if ($user) {
            Auth::loginUsingId($user->codigoe);
            return redirect()->intended('/home');
        } else {
            // Las credenciales son inválidas
            return back()->with('error', 'Credenciales inválidas');
        }
    }

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
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }


}
