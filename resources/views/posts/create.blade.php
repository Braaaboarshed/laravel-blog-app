@extends('layout')

@section('title', 'Create Post')

@section('content')
<h1>Create New Post</h1>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Title Field -->
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <!-- Content Field -->
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
    </div>

    <!-- Category Field -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
            <option value="" disabled selected>Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tags Field -->
    <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
        <select class="form-select tags-input" id="tags" name="tags[]" multiple>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-success">Save Post</button>
</form>

<!-- Include Select2 Library -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.tags-input').select2({
            placeholder: 'Select or Add Tags',
            tags: true, // Allows users to add new tags
        });
    });
</script>
@endsection
