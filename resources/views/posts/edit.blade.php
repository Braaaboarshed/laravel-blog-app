@extends('layout')

@section('title', 'Edit Post')

@section('content')
<h1>Edit Post</h1>

<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- Use PUT for updates -->

    <!-- Title Field -->
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" required>
    </div>

    <!-- Content Field -->
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" name="content" rows="4" required>{{ old('content', $post->content) }}</textarea>
    </div>

    <!-- Category Field -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select" id="category_id" name="category_id" required>
            <option value="" disabled>Select a Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Tags Field -->
    <div class="mb-3">
        <label for="tags" class="form-label">Tags</label>
        <select class="form-select tags-input" id="tags" name="tags[]" multiple>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">Update Post</button>
</form>

@endsection
