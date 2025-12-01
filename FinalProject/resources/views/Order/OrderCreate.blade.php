@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header bg-primary text-white fs-5 fw-bold">
                    <i class="bi bi-cart-plus"></i> Create Order
                </div>

                <div class="card-body">

                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Order Name</label>
                            <input type="text" class="form-control form-control-lg rounded-pill" id="name" name="name" placeholder="Enter order name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Customer</label>
                            <select name="customer_id" class="form-select form-select-lg">
                                <option value="">Choose a customer...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Select Products</label>
                            <select name="product_id[]" id="product_id" class="form-select select2" multiple>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="number" min="1" class="form-control form-control-lg rounded-pill" id="quantity" name="quantity" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 btn-lg rounded-pill mt-3">
                            <i class="bi bi-check-circle"></i> Submit Order
                        </button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Choose products...",
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush
