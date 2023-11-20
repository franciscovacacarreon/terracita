<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMenu extends Model
{
    use HasFactory;
    protected $table = 'tipo_menu';
    protected $primaryKey = 'id_tipo_menu';
    protected $fillable = [
        'nombre',
        'estado'
    ];
    public $timestamps = true;
}
