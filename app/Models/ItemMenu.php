<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemMenu extends Model
{
    use HasFactory;
    protected $table = 'item_menu';
    protected $primaryKey = 'id_item_menu';
    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
        'id_tipo_menu',
        'estado'
    ];
    public $timestamps = true;

    //Para la relación con tipoMenu
    public function tipoMenu()
    {
        return $this->belongsTo(TipoMenu::class, 'id_tipo_menu');
    }

    public function Menu()
    {
        return $this->belongsToMany(Menu::class, 'menu_item_menu', 'id_item_menu', 'id_menu');
    }
}
