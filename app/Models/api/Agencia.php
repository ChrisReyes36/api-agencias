<?php

namespace App\Models\api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
{
  use HasFactory;

  protected $table = 'agencias';

  protected $fillable = [
    'agencia_id',
    'agencia_nombre',
    'agencia_direccion',
    'agencia_telefono',
  ];
}
