<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    CONST STATUS_NEW = 1;
    CONST STATUS_PERFORM = 1;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';
    protected $fillable = ['statusId', 'userId'];

}
