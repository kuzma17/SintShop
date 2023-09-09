<?php

namespace App\Http\Controllers;

use App\Cart\Cart;
use App\Http\Resources\DeliveryResource;
use App\Http\Resources\PaymentResource;
use App\Models\Delivery;
use App\Models\Good;
use App\Models\Payment;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $cart;

    public function __construct(CartService $cart){
        $this->cart = $cart;
    }

    public function index(User $user){

        $goods = $this->cart->getGoods();

        $deliveries = Delivery::getDeliveries();
        $payments = Payment::getPayments();

        return view('cart.index', [
            'goods' => $goods,
            'cart_count' => $this->cart->count(),
            'total_sum' => $this->cart->total(),

            'deliveries' => DeliveryResource::collection($deliveries),
            'payments' => PaymentResource::collection($payments),
            'user' => auth()->user()
        ]);
    }

    public function addCart(Request $request){

        $item = $this->cart->add($request);
        return json_encode([
            'good_qty' => $item->qty,
            'cart_count' => $this->cart->count(),
        ]);
    }

    public function editCart(Request $request){

        $item = $this->cart->update($request);
        return json_encode([
            //'good_qty' => $item->qty,
            'cart_count' => $this->cart->count(),
            'total_sum' => $this->cart->total()
        ]);
    }

    public function removeItemCart(Request $request){

        $this->cart->remove($request);

        return json_encode([
            'cart_count' => $this->cart->count(),
            'total_sum' => $this->cart->total()
        ]);
    }

    public function cleanCart(){
        $this->cart->destroy();
    }
}
