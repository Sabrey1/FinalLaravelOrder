@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Order List') }}</div>

                    <div class="card-body">
                        <table class="table">
                              <a href="{{route('order.create')}}" class="btn btn-primary mb-3">Add New Order</a>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $ord)
                                    <tr>
                                        <th scope="row">{{ $ord->id }}</th>
                                        <td>{{ $ord->name }}</td>
                                        <td>{{ $ord->product_id }}</td>
                                        <td>{{ $ord->quantity }}</td>
                                        <td>{{ $ord->total_amount }}</td>
                                        <td>
                                            <a href="{{ route('order.show', $ord->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('order.edit', $ord->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('order.destroy', $ord->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this order?')">Delete</button>
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
