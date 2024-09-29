<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    public function run(): void
    {
        OrderStatus::updateOrCreate(['id' => 1], ['name' => 'pending']);
        OrderStatus::updateOrCreate(['id' => 2], ['name' => 'approved']);
        OrderStatus::updateOrCreate(['id' => 3], ['name' => 'finished']);
        OrderStatus::updateOrCreate(['id' => 4], ['name' => 'cancelled']);
    }
}
