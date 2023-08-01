<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsSeed = [
            [
                'id' => 1,
                'name' => 'Cappuccino',
                'href' => '#',
                'imageSrc' => 'https://brewespressocoffee.com/wp-content/uploads/2022/01/Cappuccino-in-white-cup-on-a-saucer.jpg',
                'imageAlt' => "Cappuccino.",
                'price' => '35',
                'color' => 'Black',
            ],
            [
                'id' => 2,
                'name' => 'Coffe espresso',
                'href' => '#',
                'imageSrc' => 'https://comohacercafe.com/wp-content/uploads/2020/03/espresso.jpeg',
                'imageAlt' => "Espresso.",
                'price' => '35',
                'color' => 'Aspen White',
            ],
            [
                'id' => 3,
                'name' => 'Coffe lahoya',
                'href' => '#',
                'imageSrc' => 'https://comohacercafe.com/wp-content/uploads/2020/03/espresso.jpeg',
                'imageAlt' => "Front of men's Basic Tee in black.",
                'price' => '35',
                'color' => 'Charcoal',
            ],
            [
                'id' => 4,
                'name' => 'Coffe maths of espresso',
                'href' => '#',
                'imageSrc' => 'https://assets.telegraphindia.com/telegraph/e8353e64-2b2f-40c3-a61c-1a04fe077f09.jpg',
                'imageAlt' => "Front of men's Basic Tee in black.",
                'price' => '35',
                'color' => 'Iso Dots',
            ],
        ];

        foreach ($productsSeed as $product) {
            $product['reference'] = Str::uuid();
            try {
                $product['stock'] = random_int(1, 100);
            } catch (\Exception $e) {

            }
            $product['category_id'] = 1;
            $product['image_url'] = $product['imageSrc'];
            $product['weight'] = 0.2;
            \App\Models\Product::create([
                'name' => $product['name'],
                'reference' => $product['reference'],
                'price' => $product['price'],
                'weight' => $product['weight'],
                'stock' => $product['stock'],
                'image_url' => $product['image_url'],
                'category_id' => $product['category_id'],
            ]);
        }
    }
}
