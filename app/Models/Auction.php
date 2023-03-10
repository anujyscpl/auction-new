<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Auction extends Model
{
    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'auctions';

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
        'name',
        'start_date',
        'end_date',
        'status',
        'created_by'
    ];


}