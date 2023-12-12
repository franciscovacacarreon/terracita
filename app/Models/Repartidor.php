<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repartidor extends Model
{
    use HasFactory;
    protected $table = 'repartidor';
    protected $primaryKey = 'id_repartidor';
    protected $fillable = [
        'id_repartidor',
        'licencia_conducir',
        'imagen',
        'estado'
    ];
    public $timestamps = true;

    public function pedido()
    {
        return $this->hasMany(Pedido::class, 'id_repartidor');
    }
}
