<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProductAuthentication extends Model
{
    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'product_authentications';

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
        'auth_id',
        'product_id',
        'grade',
        'created_by'
    ];

    /**
     * The authenticator vendor that belongs to the product.
     * @return BelongsTo
     */
    public function authenticator():BelongsTo
    {
        return $this->belongsTo(Authenticator::class, 'authenticator_id');
    }


}
