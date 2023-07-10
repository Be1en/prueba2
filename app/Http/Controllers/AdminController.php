<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\producto;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
        public function admin()
        {
            $productos = producto::all();
            return view('admin', compact('productos'));
        }

        public function create()
        {
            return view('create');
        }

        public function update(Request $request, $id)
        {
            $producto = Producto::find($id);
            if (!$producto) {
                return redirect()->back()->with('error', 'El producto no existe.');
            }

            $datosProducto = $request->except('_token');
            
            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes/productos/1'), $nombreImagen);
                $datosProducto['ruta'] = $nombreImagen;
            }

            $producto->update($datosProducto);

            return redirect()->route('admin')->with('success', 'El producto ha sido actualizado exitosamente.');
        }

        public function showUpdateForm($id)
        {
            $producto = Producto::find($id);
            return view('update', compact('producto'));
        }

        //aqui es donde se crean para la tabla productos
        public function store(Request $request)
        {
            $datosProducto = $request->except('_token');

            if ($request->hasFile('imagen')) {
                $imagen = $request->file('imagen');
                $nombreImagen = $imagen->getClientOriginalName();
                $imagen->move(public_path('imagenes/productos/1'), $nombreImagen);
                $datosProducto['ruta'] = $nombreImagen;

                //$carpetaDestino = resource_path('views/imagenes/productos/1');
                //$imagen->move($carpetaDestino, $nombreImagen);
                //$datosProducto['ruta'] = $nombreImagen;
            }

            Producto::create($datosProducto);

            return redirect()->route('admin')->with('success', 'El producto ha sido guardado exitosamente.');
        }

        

        //esto es para eliminar 
        public function eliminar($id)
        {
            $producto = Producto::find($id);
            if (!$producto) {
                return redirect()->back()->with('error', 'El producto no existe.');
            }

            $producto->delete();

            return redirect()->route('admin')->with('success', 'El producto ha sido eliminado exitosamente.');
        }
    
}
