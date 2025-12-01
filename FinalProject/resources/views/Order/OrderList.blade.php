@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Order List') }}</div>

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <a href="{{ route('order.create') }}" class="btn btn-primary mb-3">Add New Order</a>
                        <a href="{{ route('orders.export.all') }}" class="btn btn-success">Export All</a>
                    </div>

                    {{-- Search Form --}}
                    <div class="mb-3">
                        <form action="{{ route('order.index') }}" method="GET">
                            <div style="display:flex; gap:10px;">
                                <input type="text" name="search" class="form-control me-2" placeholder="Search by order name or customer" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ route('order.index') }}" class="btn btn-secondary ms-2">Clear</a>
                            </div>
                        </form>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Order Name</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Products</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>
                                        <ul>
                                            @foreach($order->products as $product)
                                                <li>
                                                    {{ $product->name }} - Qty: {{ $product->pivot->quantity }} - Price: ${{ $product->pivot->price }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>${{ $order->total_amount }}</td>
                                    <td>
                                        <a href="{{ route('order.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('order.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form id="deleteForm{{ $order->id }}" action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm" onclick="return confirmDelete({{ $order->id }})">Delete</button>
                                        </form>
                                        <a href="{{ route('orders.export.id', $order->id) }}" class="btn btn-info btn-sm">Export</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm' + id).submit();
        }
    });
}

// Show success alert
@if(session('delete') || session('create') || session('update'))
Swal.fire({
    icon: 'success',
    title: '{{ session('delete') ? "Deleted!" : (session('create') ? "Created!" : "Updated!") }}',
    text: '{{ session('delete') ?? session('create') ?? session('update') }}',
    confirmButtonText: 'OK'
});
@endif
</script>
@endpush
