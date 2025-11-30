@extends('layouts.app')
@section('content')
    <div >
        <h1>Category Details</h1>

         <div class="card">
            <div class="card-body">
                <h2 class="fw-bold">Name: {{$category->name}}</h2>
                <p class="card-text mb-0">Description: {{$category->description}}</p>
                <p class="card-text mb-0">Created At: {{ $category->created_at->format('d/m/Y') }}</p>
                <p class="card-text">Updated At: {{ $category->updated_at->format('d/m/Y') }}</p>

                <a href="{{ route('category.index') }}" class="btn btn-secondary mt-3">Back</a>
                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary mt-3">Edit</a>
            </div>
        </div>
    </div>
@endsection
