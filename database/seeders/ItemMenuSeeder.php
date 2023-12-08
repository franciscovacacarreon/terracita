<?php

namespace Database\Seeders;

use App\Models\ItemMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItemMenu::create([
            'nombre' => 'Empanada napolitana',
            'precio' => '10',
            'descripcion' => 'sin descripcion',
            'id_tipo_menu' => 1,
        ]);

        ItemMenu::create([
            'nombre' => 'Batido de banana',
            'precio' => '5',
            'descripcion' => 'sin descripcion',
            'id_tipo_menu' => 1,
        ]);

        ItemMenu::create([
            'nombre' => 'Pollo al jugo',
            'precio' => '15',
            'descripcion' => 'sin descripcion',
            'id_tipo_menu' => 2,
        ]);

        ItemMenu::create([
            'nombre' => 'Chancho al horno',
            'precio' => '20',
            'descripcion' => 'sin descripcion',
            'id_tipo_menu' => 2,
        ]);
    }
}
