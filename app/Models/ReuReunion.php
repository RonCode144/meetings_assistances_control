<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use OwenIt\Auditing\Contracts\Auditable;

class ReuReunion extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'reureuniones';

    protected $fillable = [
        'user_id',
        'tema',
        'instructor',
        'lugar',
        'responsable',
        'empresa',
        'gerencia',
        'activo',
        'fechaInicio',
        'fechaFinal',
    ];

    protected $appends = ['id_crypt']; //Appends, todo en minúscula separado del guión bajo

    //Esta función se convierte en atributo en el controlador ReuAsistentesController
    public function asistentes()
    {
        return $this->hasMany(ReuAsistentes::class, 'reureunion_id');
    }

    /**
     * La función getIdCryptAttribute cifra el valor del atributo id utilizando la clase Crypt en PHP.
     *
     * @return el valor cifrado del atributo "id" utilizando el método Crypt::encryptString().
     */
    public function getIdCryptAttribute() //Definición de Accesors (getNombreMetodoAttribute)
    {
        return Crypt::encryptString($this->id);
    }

    /**
     * La función `activo` devuelve un objeto Attribute que verifica si la propiedad `fechaInicio` es
     * igual a la fecha y hora actuales.
     *
     * @return Attribute una instancia de la clase Atributo.
     */
    public function activo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($this->fechaInicio)->format('d/m/Y') == Carbon::now()->format('d/m/Y')
                                    && Carbon::now()->format('d/m/Y H:i') > Carbon::parse($this->fechaInicio)->format('d/m/Y H:i'),
            set: fn ($value) => $value,
        );
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }
}
