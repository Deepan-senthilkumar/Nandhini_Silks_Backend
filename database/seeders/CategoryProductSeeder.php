<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Sarees', 'slug' => 'sarees'],
            ['name' => 'Men', 'slug' => 'mens'],
            ['name' => 'Kids', 'slug' => 'kids'],
            ['name' => 'Women', 'slug' => 'women'],
        ];

        foreach ($categories as $cat) {
            $category = \App\Models\Category::create($cat);

            // Add some products for each category
            for ($i = 1; $i <= 8; $i++) {
                \App\Models\Product::create([
                    'category_id' => $category->id,
                    'name' => "{$category->name} Product {$i}",
                    'slug' => \Illuminate\Support\Str::slug("{$category->name} Product {$i}"),
                    'description' => "This is a premium {$category->name} product description.",
                    'price' => rand(1000, 5000),
                    'is_featured' => $i <= 4,
                    'image_path' => 'pro.png' // Fallback image
                ]);
            }
        }
    }
}
