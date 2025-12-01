@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Create New Customer</h1>
        <form action="{{ route('customer.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Customer Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create Customer</button>
        </form>
    </div>
@endsection
