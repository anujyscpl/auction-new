<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Authenticator extends Model
{
    /**
     * Table.
     *
     * @var string
     */
    protected $table = 'authenticators';

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
        'status',
    ];


}