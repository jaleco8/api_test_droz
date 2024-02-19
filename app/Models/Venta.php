<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = ['cliente', 'producto', 'cantidad', 'precio', 'total', 'fecha', 'observaciones', 'estado', 'user_id'];
}
