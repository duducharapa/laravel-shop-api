<?php
namespace App\Http\Repositories;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartItemRepository {

    public function find(int $id): CartItem {
        return CartItem::find($id);
    }

    public function existsOnCart(int $productId, int $cartId): bool {
        $existentProduct = CartItem::where("product_id", $productId)->where("cart_id", $cartId)->get();

        return $existentProduct == null;
    }

    public function create(array $input, Cart $cart, Product $product): void {
        $newItem = new CartItem($input);

        $cart->addItem($newItem, $product);
    }

    public function update(CartItem $item, array $input): void {
        $item->update($input);
    }

    public function delete(int $id): void {
        CartItem::destroy($id);
    }

}