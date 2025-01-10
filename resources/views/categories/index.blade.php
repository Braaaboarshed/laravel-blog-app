<!--  resources/views/categories/index.blade.php -->

@extends('layout')

@section('title', 'Categories')

@section('content')
<div class="container mt-4">
    <h1>Categories</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>

    @foreach ($categories as $category)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <strong>{{ $category->name }}</strong>

                    <!--    -->
                    <div>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>

                    <img  src="{{ asset($category->image) }}" alt="Category Image" class="img-thumbnail mt-2" width="100">

            </div>
        </div>
    @endforeach
</div>
@endsection
