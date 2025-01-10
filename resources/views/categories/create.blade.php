<!--  resources/views/categories/create.blade.php -->

@extends('layout')

@section('title', 'Create Category')

@section('content')
<div class="container mt-4">
    <h1>Create Category</h1>

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Category Image (Optional)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-success">Create Category</button>
    </form>
</div>
@endsection
