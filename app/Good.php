<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Good extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'goods';
    
    protected $fillable = ['name', 'price', 'amount', 'description'];

}
