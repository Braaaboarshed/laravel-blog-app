<!-- في resources/views/categories/edit.blade.php -->

@extends('layout')

@section('title', 'Edit Category')

@section('content')
<div class="container mt-4">
    <h1>Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Category Image (Optional)</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($category->image)
                <img src="{{ Storage::url($category->image) }}" alt="Category Image" class="img-thumbnail mt-2" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-success">Update Category</button>
    </form>
</div>
@endsection
