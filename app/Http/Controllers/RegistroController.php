<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\usuarios;
use Illuminate\Http\Request;

class RegistroController extends Controller
{
    public function registrarCliente(Request $request){
        
        $password = $request->input('password');
        $repassword = $request->input('repassword');
        // Validar las contraseñas
        if ($password !== $repassword) {
            $inputData = $request->except('password', 'repassword');
            return back()->with('error', 'Las contraseñas no coinciden')->withInput($inputData);
        }

         // Crear un nuevo cliente
        $cliente = new cliente();
        $cliente->nombres = $request->input('nombres');
        $cliente->apellidos = $request->input('apellidos');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->dni = $request->input('dni');
        $cliente->save();

        // Crear un nuevo usuario y asignar el id_cliente
        $usuario = new usuarios();
        $usuario->id_cliente = $cliente->id;
        $usuario -> usuario = $request->input('usuario');
        $usuario->password = bcrypt($password);
        $usuario->save();
        
        return redirect()->route("login")->with('success', 'Agregado con exito!');
    }

}

