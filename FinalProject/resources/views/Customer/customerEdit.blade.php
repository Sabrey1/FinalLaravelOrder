@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Customer</h1>
        <form action="{{ route('customer.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Customer Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $customer->name }}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $customer->email }}" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $customer->phone }}" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required>{{ $customer->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Customer</button>
        </form>
    </div>
@endsection
