@extends('layouts.app')
@section('content')
    <div >
        <h1>Product Details</h1>
         <div class="card">
            <div class="card-body">
                <h2 class="fw-bold">Name: {{$product->name}}</h2>
                <p class="card-text mb-0">Category: {{$product->category_id}}</p>
                <p class="card-text mb-0">Price: {{$product->price}}</p>
                <p class="card-text mb-0">Description: {{$product->description}}</p>
                <p class="card-text mb-0">Created At: {{ $product->created_at->format('d/m/Y') }}</p>
                <p class="card-text">Updated At: {{ $product->updated_at->format('d/m/Y') }}</p>

                <a href="{{ route('product.index') }}" class="btn btn-secondary mt-3">Back</a>
                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary mt-3">Edit</a>
            </div>
        </div>
    </div>
@endsection
