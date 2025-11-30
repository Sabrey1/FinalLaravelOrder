<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.id as id',
                'products.name as name',
                'products.price as price',
                'products.description as description',
                'categories.name as category_name'
            )
            ->get();

        return view('Product.ProductList', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('Product.productCreate', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',

        ]);
        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        // $product->image = $request('image');
        $product->save();

        return redirect()->route('product.index')->with('create', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, $id)
    {
         $product = Product::with('category')->findOrFail($id);
        return view('Product.ProductShow', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $id)
    {
         $categories = Category::all();
        $product = Product::find($id);
        return view('Product.ProductEdit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, $id)
    {
        $product = Product::find($id);
        if($product){
            $product->update($request->all());
        return redirect()->route('product.index')->with('update', 'Product updated successfully.');
            // return redirect()->route('product.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('delete', 'Product deleted successfully.');
    }
}
