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
                'name' => 'Basic Tee',
                'href' => '#',
                'imageSrc' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg',
                'imageAlt' => "Front of men's Basic Tee in black.",
                'price' => '35',
                'color' => 'Black',
            ],
            [
                'id' => 2,
                'name' => 'Basic Tee',
                'href' => '#',
                'imageSrc' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-02.jpg',
                'imageAlt' => "Front of men's Basic Tee in black.",
                'price' => '35',
                'color' => 'Aspen White',
            ],
            [
                'id' => 3,
                'name' => 'Basic Tee',
                'href' => '#',
                'imageSrc' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-03.jpg',
                'imageAlt' => "Front of men's Basic Tee in black.",
                'price' => '35',
                'color' => 'Charcoal',
            ],
            [
                'id' => 4,
                'name' => 'artwork Tee',
                'href' => '#',
                'imageSrc' => 'https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-04.jpg',
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
