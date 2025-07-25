<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class LogoutController extends Controller
{
   public function Store(Request $request)
{
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
}
}
