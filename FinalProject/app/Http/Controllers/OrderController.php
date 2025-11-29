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
        return response()->json($order);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Order.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request-> validate([
            'name'=> 'required',
            'quantity' => 'quantity'
        ]);

        $order = new Order();
        $order-> name = $request('name');
        $order -> quantity = $request('quantity');
        $order -> product_id = $request('product_id');
        $order -> total_amount = $request('total_amount');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, $id)
    {
        $order = Order::find($id);
        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order, $id)
    {
        $order = Order::find($id);
        return view('Order.Edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
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
