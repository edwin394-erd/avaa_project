<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index(){
        if (auth()->check()) {
            return redirect(route('home'));

        } else {
            return view('auth.login');
        }

    }

    public function store(Request $request){
        //validacion
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            return back()->with('error', 'Email o contraseña incorrectos');
        }

        return redirect(route('home'));
    }
}
