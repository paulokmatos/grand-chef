<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $this->callOnce([CategorySeeder::class]);

        Product::create([
            'name'        => 'The Lord of the Rings',
            'category_id' => 1,
            'price'       => 50,
        ]);

        Product::create([
            'name'        => 'The Hobbit',
            'category_id' => 1,
            'price'       => 20,
        ]);

        Product::create([
            'name'        => "Harry Potter and the Sorcerer's Stone",
            'category_id' => 1,
            'price'       => 20,
        ]);

        Product::create([
            'name'        => 'Guitar',
            'category_id' => 2,
            'price'       => 800,
        ]);

        Product::create([
            'name'        => 'Drums',
            'category_id' => 2,
            'price'       => 1200,
        ]);

        Product::create([
            'name'        => 'The Avengers',
            'category_id' => 3,
            'price'       => 20,
        ]);
    }
}
