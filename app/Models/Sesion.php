<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;
    protected $table = 'sesiones';
    protected $primaryKey = 'id_sesion';
    protected $fillable = [
        'id_reserva',
        'fecha_sesion',
        'hora_inicio',
        'hora_fin',
        'descripcion_tatuaje',
        'imagen_referencia',
        'costo',
        'estado',
    ];

    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'id_reserva', 'id_reserva');
    }
}
