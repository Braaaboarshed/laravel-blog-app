@extends('layout')

@section('title', 'All Posts')

@section('content')
    <!-- محتوى الصفحة -->
    <div class="container mt-4">
        <div class="row">
            <!-- قسم الفلترة -->
            <div class="col-md-4">
                <h3>فلترة المنشورات</h3>
                <form id="filterForm">
                    <div class="mb-3">
                        <label for="category" class="form-label">الصنف</label>
                        <select class="form-select" id="category" name="category">
                            <option value="">الكل</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tags" class="form-label">التاجات</label>
                        <select class="form-select" id="tags" name="tags[]" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">تصفية</button>
                </form>
            </div>

            <!-- قسم عرض المنشورات -->
            <div id="posts" class="col-md-8">
                <h3>المنشورات</h3>
                <div class="row">
                    @forelse ($posts as $post)
                        <div class="col-md-12 mb-2 post"
                            data-category="{{ $post->category_id }}"
                            data-tags="{{ $post->tags->pluck('id')->join(',') }}">

                            <!-- جعل المنشور رابط للنقر عليه -->
                            <a >
                                <div class="card position-relative">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $post->user->profile_image ?? 'default-avatar.png' }}" alt="User Avatar"
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
                        <p>لا توجد منشورات حالياً.</p>
                    @endforelse
                </div>
            </div>


        </div>
    </div>


@endsection
