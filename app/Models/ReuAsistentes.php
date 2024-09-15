<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class ReuAsistentes extends Model implements Auditable
{
    use HasFactory;
    use Notifiable;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'reuasistentes';

    protected $fillable = [
        'identificacion',
        'name',
        'email',
        'firma',
        'reureunion_id',
    ]; //Appends, todo en minúscula separado del guión bajo

    public function reunion()
    {
        return $this->belongsTo(Reunion::class, 'reureunion_id');
    }
}
