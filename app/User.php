<?php

namespace App;

use Exception;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'amount_money', 'amount_points',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'userId', 'id');
    }

    public function cart() {
        return $this->orders()
                        ->where('statusId', Order::STATUS_NEW)
                        ->first();
    }

    public function approve() {

        $cart = $this->cart();
        if (!$cart) {
            throw new Exception('Не найден заказ');
        }

        if ($this->amount_money < $cart->summa) {
            throw new Exception('Недостаточно средств');
        }

        $this->amount_money = $this->amount_money - $cart->summa;

        DB::beginTransaction();

        $cart->statusId = Order::STATUS_APPROVED;

        if (!$cart->save()) {
            DB::rollBack();
            throw new Exception('error save cart');
        }

        if (!$this->save()) {
            DB::rollBack();
            throw new Exception('error save user');
        }

        DB::commit();

        return [
            'cart' => $cart,
            'amount_money' => $this->amount_money
        ];
    }

}
