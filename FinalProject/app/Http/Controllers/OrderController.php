<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{

     public function exportAll()
    {
        return Excel::download(new OrdersExport(), 'orders_all.xlsx');
    }

    // Export by ID
    public function exportById($id)
    {
        return Excel::download(new OrdersExport($id), "order_$id.xlsx");
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with(['products', 'customer']);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $orders = $query->paginate(10);

        return view('Order.OrderList', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('Order.OrderCreate', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'customer_id' => 'required|exists:customers,id',
        'products.*' => 'required|exists:products,id',
        'quantities.*' => 'required|integer|min:1',
    ]);

    $order = Order::create([
        'name' => $request->name,
        'customer_id' => $request->customer_id,
    ]);

    $total = 0;

    foreach ($request->products as $index => $productId) {
        $product = Product::find($productId);
        $quantity = $request->quantities[$index];
        $price = $product->price;

        $order->products()->attach($productId, [
            'quantity' => $quantity,
            'price' => $price
        ]);

        $total += $price * $quantity;
    }

    $order->update(['total_amount' => $total]);

    return redirect()->route('order.index')->with('success', 'Order created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(Order $order, $id)
    {

       $order = Order::with('products', 'customer')->findOrFail($id);
        return view('Order.OrderShow', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order, $id)
    {

        $customers = Customer::all();
        $products = Product::all();
        $order = Order::find($id);
        return view('Order.OrderEdit', compact('order', 'customers', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string',
        'customer_id' => 'required|exists:customers,id',
        'products.*' => 'required|exists:products,id',
        'quantities.*' => 'required|integer|min:1',
    ]);

    $order = Order::findOrFail($id);

    // Update order info
    $order->update([
        'name' => $request->name,
        'customer_id' => $request->customer_id,
    ]);

    // Sync products with pivot table
    $syncData = [];
    foreach ($request->products as $index => $productId) {
        $product = Product::find($productId);
        $syncData[$productId] = [
            'quantity' => $request->quantities[$index],
            'price' => $product->price
        ];
    }
    $order->products()->sync($syncData);

    // Update total amount
    $total = array_sum(array_map(function($item) {
        return $item['quantity'] * $item['price'];
    }, $syncData));

    $order->update(['total_amount' => $total]);

    return redirect()->route('order.index')->with('update', 'Order updated successfully!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order, $id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('order.index')->with('delete', 'Order deleted successfully!');
    }
}
