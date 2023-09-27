<?php
namespace App\Http\Repositories;
use App\Models\Cart;

class CartRepository {

    public function find(int $userId, array $relations = []): Cart {
        return Cart::with($relations)->where("user_id", $userId)->firstOrFail();
    }

}