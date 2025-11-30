@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Order</div>
                <div class="card-body">
                    <form action="{{ route('order.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Order Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $order->name }}" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="product_id">Product</label>
                            <input type="text" class="form-control" id="product_id" name="product_id" value="{{ $order->product_id }}" required>
                        </div> --}}
                        <select name="product_id">
                            <option value="">-- Select Product --</option>
                            @foreach($product as $products)
                                <option value="{{ $products->id }}"
                                    {{ $order->product_id == $products->id ? 'selected' : '' }}>
                                    {{ $products->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $order->quantity }}" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="total_amount">Total Amount</label>
                            <input type="text" class="form-control" id="total_amount" name="total_amount" value="{{ $order->total_amount }}" required>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Update order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
