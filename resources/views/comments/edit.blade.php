@extends('layout')

@section('title', ' ')

@section('content')
<div class="container mt-4">
    <h1> </h1>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="content" class="form-label"></label>
            <textarea id="content" name="content" class="form-control" rows="4" required>{{ old('content', $comment->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success"> </button>
    </form>

    <a href="{{ route('posts.show', $comment->post_id) }}" class="btn btn-secondary mt-3">  </a>
</div>
@endsection
