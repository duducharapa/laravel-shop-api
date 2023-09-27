<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ProductRepository;
use App\Http\Requests\CreateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $NOT_FOUND_MESSAGE = "Não foi possível identificar um produto com esse identificador";

    public function __construct(
        protected ProductRepository $products
    )
    {}

    /**
     * Lists all products stored.
     */
    public function index() {
        $productsFound = $this->products->findAll();

        return ProductResource::collection($productsFound);
    }

    /**
     * Saves a new product on application.
     * 
     * @param CreateProductRequest $request Validated product creation request.
     */
    public function store(CreateProductRequest $request): ProductResource {
        $input = $request->only(['name', 'description', 'price']);
        $product = $this->products->create($input);

        return new ProductResource($product);
    }

    /**
     * Searches an existent product.
     * 
     * @param int $id Product identifier.
     */
    public function show(int $id): ProductResource {
        $productFound = $this->products->find($id);
        
        return new ProductResource($productFound);
    }

    /**
     * Update the data about a specific product instance.
     */
    public function update(int $id, Request $request): void {
        $input = $request->only(['quantity']);
        
        $productFound = $this->products->find($id);
        $this->products->update($productFound, $input);
    }

    /**
     * Removes an existent product instance.
     * 
     * @param int $id The product identifier.
     */
    public function destroy(int $id): void {
        $this->products->delete($id);
    }

}
