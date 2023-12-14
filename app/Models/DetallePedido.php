<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    use HasFactory;
    protected $table = 'detalle_pedido';
    //protected $primaryKey = ['id_nota_venta', 'id_item_menu', 'id_menu'];
    protected $fillable = [
        'id_pedido', 
        'id_menu', 
        'id_item_menu',
        'sub_monto', 
        'cantidad', 
        'estado'
    ];
    public $timestamps = false;

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function menuItemMenu()
    {
        return $this->belongsTo(MenuItemMenu::class, ['id_item_menu', 'id_menu']);
    }

    public function itemMenu() 
    {
        return $this->belongsTo(ItemMenu::class, 'id_item_menu');
    }
}
