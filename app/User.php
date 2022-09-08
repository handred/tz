<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    public function getOrderAttribute() {
        return $this->orders()
                        ->where('statusId', Order::STATUS_NEW)
                        ->first();
    }

    public function approve() {

        
        if (!$this->order) {
            throw new \Exception('Не найден заказ');
        }

        return $this->order->summa;
 
        if ($this->amount_money < $this->order->summa) {
            throw new \Exception('Недостаточно средств на лицевом счете');
        }

        $this->amount_money = $this->amount_money - $this->order->summa;

        if (!$this->save()) {
            throw new \Exception('error save user');
        }

        $this->order->statusId = Order::STATUS_APPROVED;
        
        if (!$this->order->save()) {
            throw new \Exception('error save order');
        }

        return $this->amount_money;
    }

}
