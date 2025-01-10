@extends('layout')

@section('title', 'Post Details')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1>{{ $post->title }}</h1>
       @can('deletePost',$post)
       <div class="dropdown">
        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $post->id }}" data-bs-toggle="dropdown" aria-expanded="false">
            &#x22EE; <!--    -->
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $post->id }}">
            <li>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('      المنشور؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">Delete</button>
                </form>
            </li>
            <li>
                <a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">Edit</a>
            </li>
        </ul>
    </div>
       @endcan
    </div>

    <div class="d-flex align-items-center mt-3">
       <img src="{{ asset('uploads/' . $post->user->image) }}"  alt="User Avatar"
             class="rounded-circle me-2" style="width: 40px; height: 40px;">
        <strong>{{ $post->user->name ?? 'Unknown User' }}</strong>
    </div>

    <p class="mt-3">{{ $post->content }}</p>

    <p><strong>Category:</strong> {{ $post->category->name }}</p>

    <p><strong>Tags:</strong>
        @foreach ($post->tags as $tag)
            <span class="badge bg-secondary">{{ $tag->name }}</span>
        @endforeach
    </p>

    <h4 class="mt-4">Comments</h4>
    @forelse($post->comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img  src="{{ asset('uploads/' . $post->user->image) }}" alt="User Avatar"
                             class="rounded-circle me-2" style="width: 30px; height: 30px;">
                        <strong>{{ $comment->user->name }}</strong>
                    </div>

                    <!--     -->
                    {{-- @if(auth()->check() && (auth()->id() == $comment->user_id || auth()->user()->is_admin)) --}}
                        <div>
                           @can('updateComment',$comment)
                           <a href="{{ route('comments.edit', $comment->id) }}" class="text-primary me-2" title="edit">
                            <i class="bi bi-pencil-square" style="font-size: 1.5rem; color: #007bff;"></i> <!--     -->
                        </a>
                           @endcan

                        @can('deleteComment', $comment)
                             <!--    -->
                             <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('      التعليق؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger" title="delete">
                                    <i class="bi bi-trash" style="font-size: 1.5rem; color: #dc3545;"></i> <!--      -->
                                </button>
                            </form>
                        @endcan
                        </div>
                    {{-- @endif --}}
                </div>
                <p class="mt-2">{{ $comment->content }}</p>
            </div>
        </div>
    @empty
        <p>no comment yet.</p>
    @endforelse

    <!--    -->
    {{-- @if(auth()->check()) --}}
        <h4 class="mt-4">Add your comment</h4>
        <form action="{{ route('comments.store',$post->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="comment" class="form-label">your comment</label>
                <textarea id="comment" name="content" class="form-control" rows="4" required></textarea>
            </div>

            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    {{-- @else
        <p> تعليق،  <a href="{{ route('login') }}"> </a>.</p>
    @endif --}}

    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">go to posts page</a>
</div>
@endsection
