<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'scryfall_id',
        'oracle_id',
        'uri',
        'scryfall_uri',

        'name',
        'cmc',
        'type_line',
        'oracle_text',
        'mana_cost',
        'colors',
        'color_identity',

        'set',
        'set_name',
        'image_uris',
        'rarity',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function wishlists(){
        return $this->belongsToMany(Wishlist::class, 'card_wishlist');
    }

}
