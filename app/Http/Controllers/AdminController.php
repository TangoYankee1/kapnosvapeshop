<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function listOrders()
    {
        if (Gate::allows('view-all-orders')) {
            $orders = Order::with('user', 'branch')->latest()->paginate(20);
        } else {
            $orders = Order::where('branch_id', auth()->user()->branch_id)
                ->with('user', 'branch')
                ->latest()
                ->paginate(20);
        }

        return view('admin.orders.list', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $this->authorize('view', $order);

        return view('admin.orders.show', compact('order'));
    }
}
