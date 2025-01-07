@extends('layout')

@section('title', 'Post Details')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1>{{ $post->title }}</h1>
       @can('deletePost',$post)
       <div class="dropdown">
        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{ $post->id }}" data-bs-toggle="dropdown" aria-expanded="false">
            &#x22EE; <!-- ثلاث نقاط عمودية -->
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $post->id }}">
            <li>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المنشور؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">مسح</button>
                </form>
            </li>
            <li>
                <a href="{{ route('posts.edit', $post->id) }}" class="dropdown-item">تعديل البوست</a>
            </li>
        </ul>
    </div>
       @endcan
    </div>

    <div class="d-flex align-items-center mt-3">
        <img src="{{ $post->user->profile_image ?? 'default-avatar.png' }}" alt="User Avatar"
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

    <h4 class="mt-4">التعليقات</h4>
    @forelse($post->comments as $comment)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ $comment->user->profile_image ?? 'default-avatar.png' }}" alt="User Avatar"
                             class="rounded-circle me-2" style="width: 30px; height: 30px;">
                        <strong>{{ $comment->user->name }}</strong>
                    </div>

                    <!-- إضافة أيقونات الحذف والتعديل -->
                    {{-- @if(auth()->check() && (auth()->id() == $comment->user_id || auth()->user()->is_admin)) --}}
                        <div>
                           @can('updateComment',$comment)
                           <a href="{{ route('comments.edit', $comment->id) }}" class="text-primary me-2" title="تعديل التعليق">
                            <i class="bi bi-pencil-square" style="font-size: 1.5rem; color: #007bff;"></i> <!-- أيقونة التعديل بأزرق فاقع -->
                        </a>
                           @endcan

                        @can('deleteComment', $comment)
                             <!-- أيقونة حذف التعليق -->
                             <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا التعليق؟');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger" title="حذف التعليق">
                                    <i class="bi bi-trash" style="font-size: 1.5rem; color: #dc3545;"></i> <!-- أيقونة الحذف باللون الأحمر الفاقع -->
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
        <p>لا توجد تعليقات بعد.</p>
    @endforelse

    <!-- إضافة تعليق جديد -->
    {{-- @if(auth()->check()) --}}
        <h4 class="mt-4">أضف تعليقك</h4>
        <form action="{{ route('comments.store',$post->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="comment" class="form-label">تعليقك</label>
                <textarea id="comment" name="content" class="form-control" rows="4" required></textarea>
            </div>

            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <button type="submit" class="btn btn-primary">إضافة تعليق</button>
        </form>
    {{-- @else
        <p>لإضافة تعليق، يرجى <a href="{{ route('login') }}">تسجيل الدخول</a>.</p>
    @endif --}}

    <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">عودة إلى كل المنشورات</a>
</div>
@endsection
