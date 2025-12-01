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
                         <div class="form-group">
                            <select name="customer_id">
                                <option value="">-- Select Customer --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                    {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="product_id">
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ $order->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $order->quantity }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
