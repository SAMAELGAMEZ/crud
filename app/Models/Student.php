<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Especificar los campos que se pueden asignar masivamente
    protected $fillable = [
        'first_name', 'last_name', 'description',
    ];
}