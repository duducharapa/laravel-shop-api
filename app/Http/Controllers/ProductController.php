<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    private $NOT_FOUND_MESSAGE = "Não foi possível identificar um produto com esse identificador";

    /**
     * Lists all products stored.
     */
    public function index(): Collection {
        return Product::all();
    }

    /**
     * Saves a new product on database.
     */
    public function store(Request $request): JsonResponse {
        try {
            $request->validate([
                'name' => ['bail', 'required', 'string', 'max:50'],
                'description' => ['bail', 'nullable', 'string', 'max:255'],
                'price' => ['bail', 'required', 'decimal:0,2', 'numeric']
            ]);
        } catch (ValidationException $ex) {
            return $this->badRequestResponse($ex->getMessage());
        }
        
        $input = $request->only(['name', 'description', 'price']);
        $newProduct = new Product($input);
        $saved = $newProduct->save();

        return $saved ?
            response()->json($newProduct) :
            $this->internalErrorResponse();
    }

    /**
     * Searches an product instance by given identifier.
     */
    public function show(int $id): JsonResponse {
        $productFound = Product::find($id);
        
        return $productFound != null ?
            response()->json($productFound) :
            $this->notFoundResponse($this->NOT_FOUND_MESSAGE);
    }

    /**
     * Update the data about a specific product instance.
     */
    public function update(int $id, Request $request): JsonResponse {
        $newQuantity = $request->integer('quantity');
        $productFound = Product::find($id);

        if ($productFound == null) {
            return $this->notFoundResponse($this->NOT_FOUND_MESSAGE);
        }

        $productFound->quantity = $newQuantity;
        $updated = $productFound->save();

        return $updated ?
            $this->noContentResponse() :
            $this->internalErrorResponse();
    }

    /**
     * Removes an instance of product identified by given id.
     */
    public function destroy(int $id): JsonResponse {
        $productFound = Product::find($id);

        if ($productFound == null) {
            return $this->notFoundResponse($this->NOT_FOUND_MESSAGE);
        }

        $deleted = Product::destroy($id);

        return $deleted > 0 ?
            $this->noContentResponse() :
            $this->notFoundResponse($this->NOT_FOUND_MESSAGE);
    }

}
