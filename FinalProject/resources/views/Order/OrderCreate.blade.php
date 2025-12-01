@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">

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
                            <select name="customer_id" class="form-select form-select-lg" required>
                                <option value="">Choose a customer...</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr>
                        <h5>Products</h5>

                        <table class="table table-bordered" id="products_table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th style="width:120px;">Quantity</th>
                                    <th style="width:50px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select name="products[]" class="form-select select2 product-select" required>
                                            <option value="">Select Product</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="quantities[]" class="form-control" min="1" value="1" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-row">&times;</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-secondary mb-3" id="add_product">+ Add Product</button>

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

    // Initialize select2 for first row
    $('.select2').select2({
        placeholder: "Choose product...",
        allowClear: true,
        width: '100%'
    });

    // Add new product row
    $('#add_product').click(function() {
        var newRow = `<tr>
            <td>
                <select name="products[]" class="form-select select2 product-select" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="quantities[]" class="form-control" min="1" value="1" required>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-row">&times;</button>
            </td>
        </tr>`;
        $('#products_table tbody').append(newRow);

        // Reinitialize select2
        $('.select2').select2({
            placeholder: "Choose product...",
            allowClear: true,
            width: '100%'
        });
    });

    // Remove product row
    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
    });

});
</script>
@endpush
