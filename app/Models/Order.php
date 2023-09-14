<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'delivery_id',
        'payment_id',
        'count',
        'summa',
        'delivery_address',
        'note',
        'status_id'
    ];

    public function goods(){
        return $this->belongsToMany(Good::class)
            ->withPivot('quantity', 'price');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function scopeSort($request){
        return $request->orderByDesc('id');
    }

    public function createOrder($data, $cart_content){

        $order = self::create($data);

        $cart_content->map(function ($cart) use ($order){
            $order->goods()
                ->attach($cart->id, [
                    'quantity' => $cart->qty,
                    'price' => $cart->price,
                ]);
        });

        return $order;
    }

}
