<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_compra extends Model
{
    use HasFactory;
    public function compra(){
        return $this->belongsTo(compra::class, 'id_compra');
    }

    public function producto(){
        return $this->belongsTo(producto::class);
    }
}
