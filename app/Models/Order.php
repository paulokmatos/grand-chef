<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(OrderProducts::class);
    }
}
