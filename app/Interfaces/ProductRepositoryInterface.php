<?php

namespace App\Interfaces;


/**
 * interface ProductRepositoryInterface.
 */
interface ProductRepositoryInterface {

    public function getAll(array $input);

    public function getProductById(int $product_id);
}
