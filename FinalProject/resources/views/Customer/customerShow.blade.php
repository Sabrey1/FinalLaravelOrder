@extends('layouts.app')
@section('content')
    <div >
        {{-- {{$customer}} --}}
        <h1>Customer Details</h1>
         <div class="card">
            <div class="card-body">
                <h2 class="fw-bold">Name: {{$customer->name}}</h2>
                <p class="card-text mb-0">Email:
                    {{ $customer->email ?? 'No email' }}
                </p>
                <p class="card-text mb-0">Phone: {{$customer->phone}}</p>
                <p class="card-text mb-0">Address: {{$customer->address}}</p>
                <p class="card-text mb-0">Created At: {{ $customer->created_at->format('d/m/Y') }}</p>
                <p class="card-text">Updated At: {{ $customer->updated_at->format('d/m/Y') }}</p>

                <a href="{{ route('customer.index') }}" class="btn btn-secondary mt-3">Back</a>
                <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-primary mt-3">Edit</a>
            </div>
        </div>
    </div>
@endsection
