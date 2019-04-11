<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = true;
    protected $fillable = [
        'id',
        'card_id',
        'retailer_id',
        'price'
    ];
}
