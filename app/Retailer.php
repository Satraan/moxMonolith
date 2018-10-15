<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'website',
        'query_key'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
