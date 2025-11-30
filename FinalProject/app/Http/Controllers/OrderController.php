<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all();
        return view('Order.OrderList', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Order.OrderCreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request-> validate([
            'name'=> 'required',
            'quantity' => 'required'
        ]);

        $order = new Order();
        $order-> name = $request->input('name');
        $order -> quantity = $request->input('quantity');
        $order -> product_id = $request->input('product_id');
        $order -> total_amount = $request->input('total_amount');
        $order->save();
        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, $id)
    {
        $order = Order::find($id);
        return view('Order.OrderShow', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order, $id)
    {
        $order = Order::find($id);
        return view('Order.OrderEdit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());
        return redirect()->route('order.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, $id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('order.index');
    }
}
