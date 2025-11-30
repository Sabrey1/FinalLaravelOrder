@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Category</div>

                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $category->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
