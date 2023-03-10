<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Auction;
use App\Models\Product;


class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @param array $input
     * @return array|bool
     */
    public function getAll(array $input): array|bool
    {
        $per_page = Product::PER_PAGE;

        $type = ($input['type']) ?? 0;

        $auction_id = self::auctionIdFilter($input);

        $products = Product::with(['images',
            'authentications' => function ($query) {
                $query->join('authenticators', 'authenticators.id', '=', 'product_authentications.authenticator_id')
                    ->select('product_authentications.*', 'authenticators.name AS authenticator_name')
                    ->orderBy('created_at', 'asc');
            }
        ])->where(['auction_id' => $auction_id, 'type' => $type]);

        if (isset($input['sub_category_id'])) {
            $products->where('products.sub_category_id', $input['sub_category_id']);
        }

        if (isset($input['created_first'])) {
            $products->orderBy('products.created_at', 'desc');
        }

        if (isset($input['created_last'])) {
            $products->orderBy('products.created_at');
        }

        if (isset($input['price_low'])) {
            $products->orderBy('products.price');
        }

        if (isset($input['price_high'])) {
            $products->orderBy('products.price', 'desc');
        }

        return $products->paginate($per_page)->toArray();
    }

    /**
     * @param $input
     * @return int|bool
     */
    protected static function auctionIdFilter($input): int|bool
    {

        if (isset($input['auction_id'])) {

            return $input['auction_id'];
        }

        $auction = Auction::where('status', 1)->orderBy('created_at', 'desc')->first();
        if (!$auction) {
            return false;
        }
        return $auction->id;
    }

    /**
     * @param int $product_id
     * @return array
     */
    public function getProductById(int $product_id): array
    {
        return Product::with(['images',
            'authentications' => function ($query) {
                $query->join('authenticators', 'authenticators.id', '=', 'product_authentications.authenticator_id')
                    ->select('product_authentications.*', 'authenticators.name AS authenticator_name')
                    ->orderBy('created_at', 'asc');
            }
        ])->where('id', $product_id)->get()->toArray();

    }
}
