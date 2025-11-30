@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Create New Product</h1>
        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            {{-- <div class="form-group">
                <label for="category_id">Category</label>
                <input type="text" class="form-control" id="category_id" name="category_id" required>
            </div> --}}
            <select name="category_id">
        <option value="">-- Select Category --</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" required>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create Category</button>
        </form>
    </div>
@endsection
