@extends('layout')

@section('title', 'User Profile')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>User Profile</h3>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center mb-3">
                <img src="{{ $user->image ?? asset('default-avatar.png') }}" alt="User Avatar"
                     class="rounded-circle me-3" style="width: 100px; height: 100px;">
                <h4>{{ $user->name }}</h4>
            </div>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Joined:</strong> {{ $user->created_at->format('d M, Y') }}</p>

            <!-- نموذج تعديل الصورة -->
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="image" class="form-label">Change Profile Picture</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
        <div class="card-footer">
            <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
        </div>
    </div>
</div>
@endsection
