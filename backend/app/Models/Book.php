<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model 
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','base_price','cover_image'
    ];


    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function discounts(){
        return $this->hasMany(DiscountPrices::class);
    }
}
