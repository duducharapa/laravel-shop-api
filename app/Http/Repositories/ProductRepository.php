<?php
namespace App\Http\Repositories;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository {

    public function findAll(): Collection {
        return Product::all();
    }

    public function create($input) {
        $newProduct = new Product($input);
        $newProduct->save();

        return $newProduct;
    }

    public function find(int $id): Product|null {
        return Product::find($id);
    }

    public function update(Product $product, array $data) {
        $product->update($data);
    }

    public function delete(int $id): void {
        Product::destroy($id);
    }

}