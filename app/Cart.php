<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orderpositions';
    protected $fillable = ['orderId', 'goodId', 'amount', 'price', 'summa'];

}
