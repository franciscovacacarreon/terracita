<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_venta';
    //protected $primaryKey = ['id_nota_venta', 'id_item_menu', 'id_menu'];
    protected $fillable = [
        'id_nota_venta', 
        'id_item_menu', 
        'id_menu', 
        'sub_monto', 
        'cantidad', 
        'estado'
    ];
    public $timestamps = false;

    public function notaVenta()
    {
        return $this->belongsTo(NotaVenta::class, 'id_nota_venta');
    }

    public function menuItemMenu()
    {
        return $this->belongsTo(MenuItemMenu::class, ['id_item_menu', 'id_menu']);
    }
}

