<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee_view';
    protected $connection = 'sqlsrv_prod';
    protected $guard = 'personal_sap';

    public $timestamps = false;
    protected $guarded = [];
}
