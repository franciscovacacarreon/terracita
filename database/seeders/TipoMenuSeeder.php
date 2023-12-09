<?php

namespace Database\Seeders;

use App\Models\TipoMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoMenu::create([
            'nombre' => 'Desayuno',
        ]);

        TipoMenu::create([
            'nombre' => 'Almuerzo',
        ]);

        TipoMenu::create([
            'nombre' => 'Cena',
        ]);
    }
}
