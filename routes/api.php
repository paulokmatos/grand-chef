<?php

declare(strict_types=1);

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Menu\ListMenuController;
use App\Http\Controllers\Orders\CreateOrderController;
use App\Http\Controllers\Orders\UpdateOrderStatusController;
use App\Http\Controllers\ProductController;

Route::apiResource('categories', CategoryController::class);
Route::apiResource('products', ProductController::class);
Route::post('orders', CreateOrderController::class);
Route::patch('orders/{order}/status', UpdateOrderStatusController::class);
Route::get('menu', ListMenuController::class);
