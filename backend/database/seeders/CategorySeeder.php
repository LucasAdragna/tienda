<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Habitacion Simple',
                'description' => 'Alojamiento ideal para una persona o estadias cortas.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Habitacion Doble',
                'description' => 'Pensada para dos personas con confort estandar.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Habitacion Twin',
                'description' => 'Dos camas individuales para compartir sin mezclar plazas.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Habitacion Triple',
                'description' => 'Opcion comoda para grupos pequenos o familias chicas.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Habitacion Cuadruple',
                'description' => 'Disenada para alojar hasta cuatro huespedes.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Junior Suite',
                'description' => 'Espacio superior con mas amplitud y detalles premium.',
                'sort_order' => 6,
            ],
            [
                'name' => 'Suite Familiar',
                'description' => 'Habitacion amplia para familias o estadias prolongadas.',
                'sort_order' => 7,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                [
                    'description' => $category['description'],
                    'sort_order' => $category['sort_order'],
                    'is_visible' => true,
                    'is_active' => true,
                ]
            );
        }
    }
}
