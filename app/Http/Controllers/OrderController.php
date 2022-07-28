<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {

    public function index() {

        $orders = Order::where('retailer_id', session('business_id'))
        ->groupBy('tracking_number')->latest()->paginate(20);

        Order::where('retailer_id', session('business_id'))->update([
            'read' => 0
        ]);

        return view('orders.index', [
            'orders' => $orders
        ]);

    }

    public function orderStatus(Request $request) {

        $validated = $request->validate([
            'order_id' => 'required',
            'status' => 'required'
        ]);

        $updated = Order::where('id', $validated['order_id'])->update(['status' => $validated['status']]);

        if($updated) {
            return back()->with('success', 'Order status is changed');
        } else {
            return back()->with('error', 'Sorry Something went wrong');
        }
    }

    public function orderRating(Request $request) {

        $validated = $request->validate([
            'order_id' => 'required',
            'rating' => 'required'
        ]);

        $updated = Order::where('id', $validated['order_id'])->update(['rating' => $validated['rating']]);
        if($updated) {
            return back()->with('success', 'Review is added');
        } else {
            return back()->with('error', 'Sorry something went wrong');
        }
    }

}
