<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
        $query = Order::leftJoin('products', 'orders.product_id', '=', 'products.id')
        ->select('orders.*', 'products.name as product_name', 'products.price as product_price'); // select both

        if ($request->has('search')) {
            $query->where('orders.name', 'like', '%' . $request->search . '%');
        }

        $order = $query->paginate(10);

        return view('Order.OrderList', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('Order.OrderCreate', compact('products'));
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

        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Invalid product!');
        }
        $totalAmount = $request->quantity * $product->price;

        $order = new Order();
        $order-> name = $request->input('name');
        $order -> quantity = $request->input('quantity');
        $order -> product_id = $request->input('product_id');
        $order->total_amount = $totalAmount;
        $order->save();
        return redirect()->route('order.index')->with('create', 'Order saved successfully!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order, $id)
    {
       $order = Order::with('product')->findOrFail($id);
        return view('Order.OrderShow', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order, $id)
    {
        $product = Product::all();
        $order = Order::find($id);
        return view('Order.OrderEdit', compact('order', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        $product = Product::find($request->product_id);

        $totalAmount = $request->quantity * $product->price;

        $order->name = $request->name;
        $order->quantity = $request->quantity;
        $order->product_id = $request->product_id;
        $order->total_amount = $totalAmount;
        $order->save();

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
