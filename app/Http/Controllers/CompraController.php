<?php

namespace App\Http\Controllers;

use App\Models\detalle_compra;
use App\Models\producto;
use App\Models\compra;
use App\Models\usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CompraController extends Controller
{
    public function compraUsuario()
    {
        $user = Auth::user();
        $compras = $user->compra()->with('detalle_compra')->get();

        return view('checkout', compact('compras'));

    }
    public function compraUsuarioPago()
    {
        $user = Auth::user();
        $compras = $user->compra()->with('detalle_compra')->first();
        //dd($compras);
        $total=0;
        foreach($compras->detalle_compra as $compra){
            $total = $total+$compra->precio*($compra->cantidad);
        }
        $compras->total=$total;
        return view('pago', compact('compras'));

    }
    
    public function carritoCompra(Request $request)
{
    $usuario = Auth::user();
    $producto = Producto::find($request->id);

    $compra = Compra::where('id_usuario', $usuario->id)
        ->where('status', '!=', 'COMPLETED')
        ->first();

    if (!$compra) {
        $compra = new Compra();
        $compra->id_usuario = $usuario->id;
        $compra->status = 'PENDING'; // Asigna el estado de la compra
        $compra->save();
    }

    $detalleCompraExistente = $compra->detalle_compra()
        ->where('id_producto', $request->id)
        ->first();

    if ($detalleCompraExistente) {
        // Actualizar la cantidad del detalle de compra existente
        $detalleCompraExistente->cantidad += 1;
        $detalleCompraExistente->save();
    } else {
        $nuevo_producto = new detalle_compra();
        $nuevo_producto->id_compra = $compra->id;
        $nuevo_producto->id_producto = $request->id;
        $nuevo_producto->nombre = $request->nombre;
        $nuevo_producto->precio = $request->precio;
        $nuevo_producto->cantidad = 1; // Establecer la cantidad inicial a 1
        $nuevo_producto->save();
    }

    return back()->with('success', 'Producto añadido')->header('Refresh', '2');
}

    
    
    

    
    public function mostrarCompras()
    {

        $user = Auth::user();
    $detalles_compras = $user->compra()->with('detalle_compra')->get();
    return view('checkout', compact('detalles_compras'));
    }
    public function mostrarComprasPago()
    {

        $user = Auth::user();
    $detalles_compras = $user->compra()->with('detalle_compra')->get();
    return view('pago', compact('detalles_compras'));

    }
    
    public function actualizarCantidad(Request $request)
    {
        $id = $request->input('id');
        $cantidad = $request->input('cantidad');
        
        // Buscar el detalle de compra por su ID
        $detalleCompra = detalle_compra::find($id);
        
        if ($detalleCompra) {
            // Actualizar la cantidad
            $detalleCompra->cantidad = $cantidad;
            $detalleCompra->save();
            
            // Devolver una respuesta exitosa
            return response()->json(['success' => true]);
        } else {
            // Devolver una respuesta de error
            return response()->json(['success' => false, 'message' => 'No se pudo actualizar la cantidad']);
        }
    }
    
    public function eliminarProducto($id)
    {
        // Buscar el detalle de compra por su ID
        $detalleCompra = detalle_compra::find($id);

        if ($detalleCompra) {
            // Eliminar el detalle de compra
            $detalleCompra->delete();

            // Recargar la página
            return redirect()->back();
        } else {
            return response()->json(['success' => false, 'message' => 'No se pudo eliminar el producto del carrito'], 400);
        }
    }
    public function getCantidadProductosCarrito()
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();
    
        // Obtener la cantidad de productos en el carrito del usuario
        $cantidadProductos = compra::where('id_usuario', $usuario->id)->sum('id');
    
        return response()->json(['id' => $cantidadProductos]);
    }
    
    
}    

