<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // Quitamos HasFactory para simplificar y evitar el error de "Undefined type"
    protected $fillable = ['amount', 'email', 'status'];
}