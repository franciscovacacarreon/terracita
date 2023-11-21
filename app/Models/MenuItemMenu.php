<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemMenu extends Model
{
    use HasFactory;
    protected $table = 'menu_item_menu';
    protected $primaryKey = ['id_item_menu', 'id_menu'];
    protected $fillable = [
        'cantidad'
    ];
    // public $timestamps = true;
}
