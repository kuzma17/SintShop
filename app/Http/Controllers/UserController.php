<?php

namespace App\Http\Controllers;


use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\Http\Resources\DeliveryResource;
use App\Http\Resources\PaymentResource;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){

        $user = auth()->user();
        $deliveries = Delivery::getDeliveries();
        $payments = Payment::getPayments();

        return view('user.profile', [
            'user' => $user,
            'deliveries' => DeliveryResource::collection($deliveries),
            'payments' => PaymentResource::collection($payments)
            ]);
    }

    public function updateProfile(UserRequest $request, User $user){

        $user->update($request->all());

        return redirect(route('user.profile'));
    }

    public function password(){
        $user = auth()->user();
        return view('user.password', ['user' => $user]);
    }

    public function updatePassword(PasswordRequest $request, User $user){
        $user->update($request->all());
        return redirect(route('user.profile'));
    }

    public function orders(Order $order){
        $user = auth()->user();
        $orders = $user->orders->load('delivery', 'payment', 'status')->paginate(10);

        return view('user.orders', ['orders' => $orders]);
    }

    public function order(Order $order){

        $order = $order->load('delivery','payment','status','goods','goods.photos');

        return view('user.order', ['order' => $order]);
    }
}
