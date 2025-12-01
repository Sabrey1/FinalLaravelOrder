@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Customer List') }}</div>

                    <div class="card-body">
                        <a href="{{route('customer.create')}}" class="btn btn-primary mb-3">Add New Customer</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
 
                                    <tr>
                                        <th scope="row">{{ $customer->id }}</th>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>

                                        <td>
                                            <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form id="deleteForm{{ $customer->id }}" action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm" onclick="return confirmDelete({{ $customer->id }})">Delete</button>
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
