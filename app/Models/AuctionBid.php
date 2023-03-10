<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AuctionBid extends Model
{
    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'auction_bids';

    /**
     * Guarded.
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'bid_price',
        'product_id',
        'auction_id',
        'old_bid_price'
    ];


}