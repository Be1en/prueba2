<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compra extends Model
{
    use HasFactory;
    public function usuarios(){
        return $this->belongsTo(usuarios::class);
    }

    public function detalle_compra(){
        return $this->hasMany(detalle_compra::class, 'id_compra');
    }
}
