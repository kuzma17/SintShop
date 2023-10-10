<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\AdminFilterService;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request, AdminFilterService $filterService){

        $query = Order::query();

        $query = $filterService->apply($query);

        $orders = $query->sort()->get()->load('user','status')->paginate(12);

        return view('admin.orders.index', ['orders' => $orders]);

    }
}
