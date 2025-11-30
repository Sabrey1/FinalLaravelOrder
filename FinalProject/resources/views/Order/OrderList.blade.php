@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Order List') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <a href="{{route('order.create')}}" class="btn btn-primary mb-3">Add New Order</a>
                                <a href="{{ route('orders.export.all') }}" class="btn btn-success">Export All</a>

                            </div>


                                <div class="mb-3">
                                    <form action="{{ route('order.index') }}" method="GET">
                                        <div style="display:flex; gap:10px;">
                                            <input type="text" name="search" class="form-control me-2" placeholder="Search by name or product" value="{{ $search ?? '' }}">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                        <a href="{{ route('order.index') }}" class="btn btn-secondary ms-2">Clear</a>
                                        </div>

                                    </form>
                                </div>
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Product Order</th>
                                    <th scope="col">Product Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $ord)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $ord->name }}</td>
                                        <td>{{ $ord->product_name }}</td>
                                        <td>$ {{ $ord->product_price }}</td>
                                        <td>{{ $ord->quantity }}</td>
                                        <td>$ {{ $ord->total_amount }}</td>
                                        <td>
                                            <a href="{{ route('order.show', $ord->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('order.edit', $ord->id) }}"  class="btn btn-warning btn-sm">Edit</a>
                                            <form id="deleteForm{{ $ord->id }}" action="{{ route('order.destroy', $ord->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="return confirmDelete({{ $ord->id }})">Delete</button>
                                            </form>
                                            <a href="{{ route('orders.export.id', $ord->id) }}" class="btn btn-info btn-sm">
                                                Export
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                       {{ $order->links('pagination::bootstrap-5') }}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
@push('scripts')

<script>
// Confirm delete
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure delete this post?',
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
</script>

{{-- ✅ Show success alert only after deletion --}}
@if(session('delete') || session('create') || session('update'))
<script>
Swal.fire({
    icon: 'success',
    title: '{{
        session('delete') ? "Deleted!" :
        (session('create') ? "Created!" :
        (session('update') ? "Updated!" :
        (session('restore') ? "Restored!" : "")))
    }}',
    text: '{{ session('delete') ?? session('create') ?? session('update') ?? session('restore') }}',
    confirmButtonText: 'OK'
});
</script>
@endif

@endpush
