<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Inventory;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders.index')->with('orders', Order::with('customer')->get());
    }

    public function create()
    {
        return response()->view('orders.create', [
            'customers'   => Customers::all(),
            'inventories' => Inventory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->fill($request->except(['_token', '_method']));
        $order->save();

        // Redirect
        return redirect()->route('orders.show', $order->id)->with('status', 'Order Confirmed.');
    }

    public function show($id)
    {
        return view('orders.show')->with('order', Order::where('id', $id)->first());
    }

    public function edit($id)
    {
        return response()->view('orders.edit', [
            'order'       => Order::where('id', $id)->first(),
            'inventories' => Inventory::all(),
            'customers'   => Customers::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->fill($request->except(['_token', '_method']));
        $order->save();

        // Redirect
        return redirect()->route('orders.show', $order->id)->with('status', 'Order Successfully Edited.');
    }

    public function destroy($id)
    {
        Order::destroy($id);

        // Redirect
        return redirect()->route('orders')->with('status', 'Order Successfully Deleted.');
    }
}
