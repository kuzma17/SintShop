<?php

namespace App\Http\Controllers;

use App\Cart\Cart;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
    }

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
        $data['quantity'] = $cart->count();
        $data['status_id'] = 1;

        $cart_content = $cart->content();
        $order = $order->createOrder($data, $cart_content);
        $cart->destroy();
        $order = $order->load('delivery', 'payment');

        return view('order.created', ['order' => $order]);

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
