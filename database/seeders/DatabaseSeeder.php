<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin Toko',
            'email' => 'admin@tokoparfum.test',
        ]);

        $categories = [
            'Eau de Parfum',
            'Eau de Toilette',
            'Parfum Pria',
            'Parfum Wanita',
            'Parfum Unisex',
        ];

        foreach ($categories as $name) {
            $category = Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);

            Product::factory()
                ->count(10)
                ->create([
                    'category_id' => $category->id,
                ]);
        }
    }
}


