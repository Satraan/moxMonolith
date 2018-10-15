<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'id',
        'user_name'
    ];

    public function cards(){
        return $this->belongsToMany(Card::class);
    }
}
