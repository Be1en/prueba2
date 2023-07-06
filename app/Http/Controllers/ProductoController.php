<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
    //
    public function mostrarCatalogo()
    {
        $productos = producto::All();
        return view('inicio')->with('productos', $productos);
    }
    public function mostrarCarrusel()
    {
        $productos = producto::All();
        return view('principal')->with('productos', $productos);
    }
    public function mostrarImagen($url)
    {
        $imagen = Storage::disk('local')->get('/productos/1/' . $url);
        return Image::make($imagen)->response();
    }
    public function detallesAuto($id){
        $producto = producto::where('id',$id)->first();
        return view('details')->with('producto',$producto);
        
    }
}
