<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ReuMiembro extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'reumiembros';

    protected $fillable = [
        'identificacion',
        'name',
        'email',
        'reureunion_id',
    ];

    public function reunion()
    {
        return $this->belongsTo(Reunion::class, 'reureunion_id');
    }
}
