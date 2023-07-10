<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    public function detalle_compra(): HasMany
    {
        return $this->hasMany(detalle_compra::class);
    }
    protected $fillable = [
        'nombre',
        'modelo',
        'descripcion',
        'precio',
        'activo',
        'kilometraje',
        'ruta',
        'disponibilidad',
        // Otros campos permitidos en la asignación masiva
    ];
}
