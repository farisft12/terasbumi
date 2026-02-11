<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'service_type',
        'service_data',
        'price',
        'original_price',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'service_data' => 'array',
            'price' => 'decimal:2',
            'original_price' => 'decimal:2',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
