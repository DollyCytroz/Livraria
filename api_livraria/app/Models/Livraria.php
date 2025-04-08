<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livraria extends Model
{
    protected $fillable = [
        'nome_livraria',
        'endereco_livraria',
        'horario_abertura',
    ]; 
}
