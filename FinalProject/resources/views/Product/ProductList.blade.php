@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Product List') }}</div>

                    <div class="card-body">
                        <a href="{{route('product.create')}}" class="btn btn-primary mb-3">Add New Product</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $prod)
                                    <tr>
                                        <th scope="row">{{ $prod->id }}</th>
                                        <td>{{ $prod->name }}</td>
                                        <td>{{ $prod->category_id }}</td>
                                        <td>{{ $prod->price }}</td>
                                        <td>{{ $prod->description }}</td>
                                        <td>
                                            <a href="{{ route('product.show', $prod->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('product.edit', $prod->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('product.destroy', $prod->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
