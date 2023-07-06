<?php

namespace App\Http\Controllers;

use App\Models\usuarios;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function verificarAdmin(Request $request){
        $usuario = $request->input('usuario');
        $password = $request->input('password');

        if ($usuario == "admin" && $password == "admin") {
            return redirect()->route('verificarAdmin');
        }else{
            return redirect()->back()->with('error', 'No se puede iniciar sesión. Verifique sus credenciales.');
        }
    }
    public function inicioSesion(Request $request)
    {
        $usuario = $request->input('usuario');
        $password = $request->input('password');
        $credenciales = $request->only('usuario', 'password');
        $id = $request->input('id');
    
        
        if ($usuario == "admin" && $password == "admin") {
            return redirect()->route('admin');
        }
        if (Auth::attempt($credenciales)) {
            request()->session()->regenerate();
            return redirect()->route('/')->with('success', 'Inicio de sesión exitoso');
        }
    
        return back()->with('error', 'Credenciales incorrectas')->withInput();
    }
    

    public function cerrarSesion(Redirector $redirect){
        Auth::logout();
        return $redirect->to('/');
    }

}