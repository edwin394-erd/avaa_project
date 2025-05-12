<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Becario;
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

        $becario = Becario::create([
            'nombre' => $request->name,
            'cedula' => $request->cedula,

        ]);

        User::create([
            'becario_id' => $becario->id,
            'email' =>$request->email,
            'password' =>Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('msg_registroExitoso', 'Registro exitoso, ya puedes iniciar sesión');
    }
}
