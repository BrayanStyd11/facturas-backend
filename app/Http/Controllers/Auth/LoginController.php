<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
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
     * Función Login, valida Email y contraseña y 
     * crea el token de seguridad e inicia sesión
     */
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email','password');

        $token = Auth::attempt($credentials);
        if(!$token){
            return response()->json(['status' => '401','message' => 'Acción denegada',],401);
        }
        
        return response()->json(['status'=> 200, 'user' => Auth::user(), 'tokenAuthorization' => ['token' => $token, 'type' => 'bearer']]);
    }

    //Función para refrescar el token cuando el mismo expire
    public function refresh(){
        return response()->json([
            'status' => 200, 
            'user' => Auth::user(), 
            'tokenAuthorization' => [
                'token'=> Auth::refresh(), 
                'type' => 'bearer'
            ]
        ]);
    }

    public function logout(){
        Auth::logout();
        return response()->json(['status' =>200, 'message'=>'Sesión Cerrada']);
    }
}
