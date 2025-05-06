<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
      
        $this->validate($request,[
            'name' => ['required', 'max:30', 'min:5','regex:/^[\\pL\\s\\-]+$/u'],
            'email' => ['required', 'max:30', 'min:5', 'unique:users','email'],
            'password' => ['required', 'max:30', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('msg_registroExitoso', 'Registro exitoso, ya puedes iniciar sesión');
    }
}
