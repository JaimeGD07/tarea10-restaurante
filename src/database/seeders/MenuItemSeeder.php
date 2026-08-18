<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Ceviche de Camarón', 'description' => 'Camarón fresco marinado en cítricos, cebolla morada y cilantro.', 'price' => 8.50, 'category' => 'entradas', 'available' => true],
            ['name' => 'Carpaccio de Res', 'description' => 'Finas láminas de res con parmesano, alcaparras y aceite de oliva.', 'price' => 9.75, 'category' => 'entradas', 'available' => true],
            ['name' => 'Risotto de Hongos', 'description' => 'Arroz cremoso con mezcla de hongos silvestres y trufa.', 'price' => 14.00, 'category' => 'fuertes', 'available' => true],
            ['name' => 'Salmón Teriyaki', 'description' => 'Filete de salmón glaseado, servido con vegetales salteados.', 'price' => 18.50, 'category' => 'fuertes', 'available' => true],
            ['name' => 'Lomo Fusión', 'description' => 'Lomo de res en salsa de soya y chile guajillo, puré de camote.', 'price' => 19.90, 'category' => 'fuertes', 'available' => false],
            ['name' => 'Volcán de Chocolate', 'description' => 'Bizcocho tibio de chocolate con centro líquido y helado de vainilla.', 'price' => 6.50, 'category' => 'postres', 'available' => true],
            ['name' => 'Cheesecake de Maracuyá', 'description' => 'Base de galleta, relleno cremoso y coulis de maracuyá.', 'price' => 6.00, 'category' => 'postres', 'available' => true],
            ['name' => 'Limonada de Coco', 'description' => 'Limonada natural con un toque de leche de coco.', 'price' => 3.50, 'category' => 'bebidas', 'available' => true],
            ['name' => 'Mocktail Tropical', 'description' => 'Mezcla de frutas tropicales sin alcohol, servido helado.', 'price' => 4.25, 'category' => 'bebidas', 'available' => true],
        ];

        foreach ($items as $item) {
            MenuItem::create($item);
        }
    }
}
