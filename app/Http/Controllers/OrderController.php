<?php

namespace App\Http\Controllers;


use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function createOrder(OrderRequest $request, CartService $cart, User $user, Order $order){

        $data = $request->all();

        $client = auth()->user();

        if(!$client){
            if (!isset($data['password'])) {
                $data['password'] = 123456;
            }
            $client = $user->createUser($data);
        }

//        $data = $request->all();
//
//        if (auth()->check()) {
//            $user = auth()->user();
//        }else{
//            if (!isset($data['password'])) {
//                $data['password'] = 123456;
//            }
//            $user = $user->createUser($data);
//        }

        $data['user_id'] = $client->id;
        $data['summa'] = $cart->totalFloat();
        $data['count'] = $cart->count();
        $data['status_id'] = 1;

        $cart_content = $cart->content();
        $order = $order->createOrder($data, $cart_content);
        $cart->destroy();
        $order = $order->load('delivery', 'payment');

        return view('order.created', ['order' => $order]);

    }

}
