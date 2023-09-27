<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'product_id',
        'quantity',
        'cart_id'
    ];

    protected $hidden = [
        'product_id',
        'cart_id'
    ];

    public function cart(): BelongsTo {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
    
}
