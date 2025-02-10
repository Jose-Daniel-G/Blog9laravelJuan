<?php

// App\Models\Clase.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = [
        'alumno_id', 'funcionario_id', 'vehiculo_id', 'curso_id', 'fecha_hora', 'duracion', 'estado'
    ];

    public function alumno()
    {
        return $this->belongsTo(User::class, 'alumno_id');
    }

    public function funcionario()
    {
        return $this->belongsTo(User::class, 'funcionario_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }
}
