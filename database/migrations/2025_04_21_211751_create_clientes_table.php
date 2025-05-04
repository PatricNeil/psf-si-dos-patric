<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('id_cliente')->autoIncrement(); // Corregido unicade() por unique()
            $table->string('nombre');
            $table->string('apellido');
            $table->text('dni'); // Cambiado a text para permitir encriptación
            $table->string('email');
            $table->string('telefono')->nullable();
            $table->text('direccion')->nullable(); // Cambiado a text para permitir encriptación
            $table->date('fecha_registro');
            $table->timestamps();
            
            // Definimos índices por separado con longitud específica para campos TEXT
            $table->unique('email');
            // No definimos índice único para DNI porque va encriptado y no funcionaría bien
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
//ota esto es un ejemplo para la aplicaion de encriptados de datos para la proteccion de los datos
/*use Illuminate\Support\Facades\Crypt;

class Cliente extends Model
{
    protected $table = 'clientes';

    // Mutators para encriptar antes de guardar
    public function setDniAttribute($value)
    {
        $this->attributes['dni'] = Crypt::encryptString($value);
    }

    public function setDireccionAttribute($value)
    {
        $this->attributes['direccion'] = Crypt::encryptString($value);
    }

    // Accessors para desencriptar al acceder
    public function getDniAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getDireccionAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}
*/