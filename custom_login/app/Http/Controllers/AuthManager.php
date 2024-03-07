<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class AuthManager extends Controller
{
    function login(){
        if (Auth::check()){
            return redirect(route('home')); //si el usuario no esta logeado no podra entrar a la pagina del login
        }
        return  view('login');
    }

    function registration(){
        if (Auth::check()){
            return redirect(route('home')); //si el usuario no esta logeado no podra entrar a la pagina del login
        }
        return  view('registration');
    }

    function loginPost(Request $request){
        $request->validate([
        'email'=> 'required', //atributos 'name' del form login, deben ser los mismos dados
        'password'=> 'required',
        ]);


        $credentials = $request->only('email' , 'password'); //solo obtenemos el  email y password para validar        
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with('error', 'Invalid credentials');
    }

    function registrationPost(Request $request){
        $request->validate([
        'name'=> 'required', //atributos 'name' del form login, deben ser los mismos dados
        'email'=> 'required|email|unique:users', //validaciones: tipo email y unico.
        'password'=> 'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password); //encriptar contraseña
        $user = User::create($data);
        if (!$user){
            return redirect(route('registration'))->with('error', 'Registration Failed, Try Again.');
        }
        return  redirect(route('login'))->with('success', 'User Registered Successfully! You can now Login.');
}

    function logout(){
        Session::flush();
        Auth::logout();
        return  redirect(route('login'));



    }
}


