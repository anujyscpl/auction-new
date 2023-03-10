<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Product extends Model
{
    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'products';

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
        'sku',
        'seller_id',
        'type',
        'asking_price',
        'current_bid_price',
        'is_live',
        'sub_category_id',
        'is_authenticated',
        'authenticator_id',
        'grade',
        'auction_id',
        'additional',
        'name',
        'description',
        'seller_id',
        'issued_year',
        'is_featured'
    ];

    public const PER_PAGE = 24;
    /**
     * Castable.
     *
     * @var array
     */
    protected $casts = [
        'additional'      => 'array'
    ];

    /**
     * The images that belong to the product.
     *
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    /**
     * The sub categories that belong to the category.
     *
     * @return BelongsTo
     */
    public function sub_category():BelongsTo {

        return  $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    /**
     * @return HasMany
     */
    public function authentications():hasMany
    {
        return $this->hasMany(ProductAuthentication::class, 'product_id');
    }
}
