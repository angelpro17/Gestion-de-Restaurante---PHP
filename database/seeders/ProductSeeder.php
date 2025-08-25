<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Entradas
            [
                'name' => 'Nachos con Guacamole',
                'description' => 'Crujientes nachos de maíz acompañados de guacamole fresco y salsa picante.',
                'price' => 8.50,
                'category' => 'entradas',
                'available' => true,
            ],
            [
                'name' => 'Alitas Buffalo',
                'description' => 'Alitas de pollo marinadas en salsa buffalo, servidas con aderezo ranch.',
                'price' => 12.00,
                'category' => 'entradas',
                'available' => true,
            ],
            [
                'name' => 'Quesadillas de Pollo',
                'description' => 'Tortillas de harina rellenas de pollo desmenuzado y queso derretido.',
                'price' => 9.75,
                'category' => 'entradas',
                'available' => true,
            ],

            // Platos principales
            [
                'name' => 'Hamburguesa Clásica',
                'description' => 'Jugosa hamburguesa de carne con lechuga, tomate, cebolla y papas fritas.',
                'price' => 15.50,
                'category' => 'platos_principales',
                'available' => true,
            ],
            [
                'name' => 'Pollo a la Parrilla',
                'description' => 'Pechuga de pollo marinada a la parrilla con vegetales asados y arroz.',
                'price' => 18.00,
                'category' => 'platos_principales',
                'available' => true,
            ],
            [
                'name' => 'Salmón Teriyaki',
                'description' => 'Filete de salmón glaseado con salsa teriyaki, acompañado de arroz y brócoli.',
                'price' => 22.50,
                'category' => 'platos_principales',
                'available' => true,
            ],
            [
                'name' => 'Pasta Alfredo',
                'description' => 'Fettuccine en cremosa salsa alfredo con pollo y champiñones.',
                'price' => 16.75,
                'category' => 'platos_principales',
                'available' => false, // Producto no disponible
            ],

            // Postres
            [
                'name' => 'Cheesecake de Fresa',
                'description' => 'Cremoso cheesecake con cobertura de fresas frescas.',
                'price' => 7.50,
                'category' => 'postres',
                'available' => true,
            ],
            [
                'name' => 'Brownie con Helado',
                'description' => 'Brownie de chocolate caliente servido con helado de vainilla.',
                'price' => 6.75,
                'category' => 'postres',
                'available' => true,
            ],
            [
                'name' => 'Tiramisú',
                'description' => 'Clásico postre italiano con café, mascarpone y cacao.',
                'price' => 8.25,
                'category' => 'postres',
                'available' => true,
            ],

            // Bebidas
            [
                'name' => 'Limonada Natural',
                'description' => 'Refrescante limonada preparada con limones frescos.',
                'price' => 3.50,
                'category' => 'bebidas',
                'available' => true,
            ],
            [
                'name' => 'Smoothie de Mango',
                'description' => 'Batido cremoso de mango con yogurt natural.',
                'price' => 5.25,
                'category' => 'bebidas',
                'available' => true,
            ],
            [
                'name' => 'Café Americano',
                'description' => 'Café negro preparado con granos premium.',
                'price' => 2.75,
                'category' => 'bebidas',
                'available' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}