<?php

namespace App;

use App\Cart;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    CONST STATUS_NEW = 1;
    CONST STATUS_APPROVED = 2;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    protected $fillable = ['statusId', 'userId'];

    public function getSummaAttribute() {
        return $this->positions()->sum('summa');
    }

    public function positions() {
        return $this->hasMany(Cart::class, 'orderId');
    }

}
