<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oficina extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'direccion'];

    public function empleados()
    {
        return $this->hasMany(Empleado::class);
    }
}
