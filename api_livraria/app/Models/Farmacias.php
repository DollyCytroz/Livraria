<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmacias extends Model
{
    protected $fillable = [
        'nome_farmacia',
        'endereco_farmacia',
        'horario_farmacia',
    ]; 
}
