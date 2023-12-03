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

    //Relación de uno a muchos con tipo menú (un item menu pertenece a un tipo y un tipo puede estar en muchos items menu)
    public function itemMenu()
    {
        return $this->hasMany(ItemMenu::class, 'id_tipo_menu');
    }
}
