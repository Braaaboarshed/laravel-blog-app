@extends('layout')

@section('title', 'All Posts')

@section('content')
    <!--   -->
    <div class="container mt-4">
        <div class="row">
            <!--   -->
            <div class="col-md-4">
                <h3>Filter the posts</h3>
                <form id="filterForm">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">All</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <select class="form-select" id="tags" name="tags[]" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">filter</button>
                </form>
            </div>

            <!--    -->
            <div id="posts" class="col-md-8">
                <h3>Posts</h3>
                <div class="row">
                    @forelse ($posts as $post)
                        <div class="col-md-12 mb-2 post"
                            data-category="{{ $post->category_id }}"
                            data-tags="{{ $post->tags->pluck('id')->join(',') }}">

                            <!--      -->
                            <a >
                                <div class="card position-relative">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img  src="{{ asset('uploads/' . $post->user->image) }}"  alt="User Avatar"
                                                 class="rounded-circle me-2" style="width: 40px; height: 40px;">
                                            <strong>{{ $post->user->name ?? 'Unknown User' }}</strong>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-link"><a href="{{ route('posts.show', $post->id) }}">{{$post->title}}</a></h3>
                                        <p class="card-text">{{ $post->content }}</p>
                                        <p><strong>Category:</strong> {{ $post->category->name }}</p>
                                        <p><strong>tags:</strong>
                                            @foreach ($post->tags as $tag)
                                                <span class="badge bg-secondary">{{ $tag->name }}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </a>

                        </div>
                    @empty
                        <p>No result.</p>
                    @endforelse
                </div>
            </div>


        </div>
    </div>


@endsection
