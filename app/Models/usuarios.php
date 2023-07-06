<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;


class usuarios extends Model implements Authenticatable
{
    use HasFactory;
    public function cliente(){
        return $this->hasOne(cliente::class, 'id_cliente');
    }

    public function compra(){
        return $this->hasOne(compra::class, 'id_usuario');
    }

    public function getAuthIdentifierName()
    {
        return 'id'; 
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password; // Reemplaza 'password' por el nombre del atributo de contraseña en tu tabla de usuarios
    }

    public function getRememberToken()
    {
        return $this->{$this->getRememberTokenName()};
    }

    public function setRememberToken($value)
    {
        $this->{$this->getRememberTokenName()} = $value;
    }

    public function getRememberTokenName()
    {
        return 'token'; // Reemplaza 'remember_token' por el nombre del atributo de token de recuerdo en tu tabla de usuarios
    }



}
