<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getOrderProducts(array $products): array
    {
        $dbProducts = Product::whereIn('id', array_column($products, 'id'))
            ->select('id', 'name', 'price')->get()->toArray();

        foreach ($dbProducts as &$dbProduct) {
            $dbProduct['count'] = $this->getCountById($products, $dbProduct['id']);
        }

        return $dbProducts;
    }

    private function getCountById(array $products, int $id): ?int
    {
        foreach ($products as $product) {
            if ($product['id'] == $id) {
                return $product['count'] ?? null;
            }
        }
    }
}
