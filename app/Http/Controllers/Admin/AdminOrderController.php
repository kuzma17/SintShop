<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\AdminFilterService;
use App\Models\Status;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request, AdminFilterService $filterService){

        $query = Order::query();

        $query = $filterService->apply($query);

        $orders = $query->sort()->get()->load('user','status')->paginate(12);

        return view('admin.orders.index', ['orders' => $orders]);

    }

    public function edit(Order $order){

        $order = $order->load('goods', 'goods.photos');
        $statuses = Status::active()->sort()->get();

        return view('admin.orders.edit', ['order' => $order, 'statuses' =>$statuses]);

    }

    public function update(Request $request, Order $order){

        $order->update($request->all());

        if ($order->status_id == 2){

            $this->writeOffGoods($order->goods);

        }

        return redirect(route('admin.orders.index'));
    }

    public function writeOffGoods($goods){
        $goods->map(function ($good){
            $good->quantity = $good->quantity - $good->pivot->quantity;
            $good->save();
        });
    }
}
