<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountPrices extends Model 
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price','book_id','start_date','end_date'
    ];

    protected $table = "discount_prices";
}
