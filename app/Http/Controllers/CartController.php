<?php

namespace App\Http\Controllers;

use App\Http\Repositories\CartItemRepository;
use App\Http\Repositories\CartRepository;
use App\Http\Repositories\ProductRepository;
use App\Http\Requests\AddCartItemRequest;
use App\Http\Requests\ChangeCartItemRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    private $PRODUCT_NOT_FOUND_MESSAGE = "Não foi possível identificar um produto com esse identificador";
    private $ALREADY_EXISTS_MESSAGE = "O produto já foi adicionado ao carrinho";
    private $INSUFICIENT_QUANTITY_MESSAGE = "O produto especificado não possui a quantidade desejada em estoque";

    public function __construct(
        protected CartRepository $carts,
        protected ProductRepository $products,
        protected CartItemRepository $items
    )
    {}

    /**
     * 
     */
    public function index(Request $request): CartResource {
        $ownerId = $request->user()->id;
        $cart = $this->carts->find($ownerId, ['items', 'items.product']);

        return new CartResource($cart);
    }

    /**
     * 
     */
    public function create(AddCartItemRequest $request): void {
        $input = $request->only(['product_id', 'quantity']);
        $ownerId = $request->user()->id;

        $cartFound = $this->carts->find($ownerId);
        $productFound = $this->products->find($input['product_id']);
       
        //$itemExists = $this->items->existsOnCart($productFound->id, $cartFound->id);
        //$notEnough = $productFound->quantity < $input['quantity'];

        $input['cart_id'] = $cartFound->id;
        $this->items->create($input, $cartFound, $productFound);
    }

    public function update(ChangeCartItemRequest $request, int $itemId): void {
        $input = $request->only(['quantity']);
        
        $itemFound = $this->items->find($itemId);
        
        $this->items->update($itemFound, $input);
    }

    public function destroy(Request $request, int $itemId) {
        $this->items->delete($itemId);
    }

}
