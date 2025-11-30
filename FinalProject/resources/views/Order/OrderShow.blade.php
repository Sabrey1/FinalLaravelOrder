@extends('layouts.app')
@section('content')
    <div >
        <h1>Order Details</h1>
         <div class="card">
            <div class="card-body">
                <h2 class="fw-bold">Name: {{$order->name}}</h2>
                <p class="card-text mb-0">Product:
                    {{ $order->product->name ?? 'No product' }}
                </p>
                <p class="card-text mb-0">Quantity: {{$order->quantity}}</p>
                <p class="card-text mb-0">Total Amount: {{$order->total_amount}}</p>
                <p class="card-text mb-0">Created At: {{ $order->created_at->format('d/m/Y') }}</p>
                <p class="card-text">Updated At: {{ $order->updated_at->format('d/m/Y') }}</p>

                <a href="{{ route('order.index') }}" class="btn btn-secondary mt-3">Back</a>
                <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary mt-3">Edit</a>
            </div>
        </div>
    </div>
@endsection
