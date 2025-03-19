<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DB;
use Socialite;
use App\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only'=>'showLogin']);
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->to('dashboard');
        }else{
            return view('auth.login');
        }
    }


    public function login()
    {

        $credentials = $this->validate(
            request(), [
            'email'=>'required|email|string',
            'password'=>'required|string'
            ]
        );


        if(Auth::attempt($credentials)) {
            $current_user = DB::table('users')
                ->where('email', '=', $credentials['email'])
                ->first();

            if($current_user->role == 'ADMIN') {
                return redirect()->route('dashboard');
            }else if($current_user->role == 'USER') {
                return redirect()->route('inicio');
            }  
        }
        return back()->withErrors(['email'=>'Estas credenciales no concuerdan con nuestra Base de Datos'])
            ->withInput(request(['email']));
        
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user(); 
        // Comprobamos si el usuario ya existe
        if ($user = User::where('email', $social_user->email)->first()) { 
            return $this->authAndRedirect($user); // Login y redirección
        } else {  

            dd($social_user);
            // En caso de que no exista creamos un nuevo usuario con sus datos.
            $user = new  User;
            $user->name = $social_user->name;
            $user->email = $social_user->email;
            $user->role = 'USER';
            $user->password = 'facebook';
            $user->save();
            return $this->authAndRedirect($user); // Login y redirección
        }
    }
 
    // Login y redirección
    public function authAndRedirect($user)
    {
        Auth::login($user);
 
        return redirect()->to('/');
    }
}
