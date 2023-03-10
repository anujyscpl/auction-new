<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ResponseTrait;
    public ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function products(Request $request): JsonResponse
    {
        $input = $request->only(['type','auction_id', 'created_first', 'created_last','price_low','price_high','sub_category_id','authenticator_id']);


        if ($products = $this->productRepository->getAll($input)) {

            return $this->responseSuccess($products);
        }

        return $this->responseError('Products not found');
    }


    /**
     * Create a new controller instance.
     *
     * @param  int $product_id
     * @return JsonResponse
     */

    public function productDetails(int $product_id): JsonResponse
    {

        if ($product = $this->productRepository->getProductById($product_id)) {

            return $this->responseSuccess($product);
        }

        return $this->responseError('Invalid product id');
    }

}
