@extends('layout')

@section('title', 'Create Tag')

@section('content')
<div class="container mt-4">
    <h1>إضافة تاغ جديد</h1>

    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">الاسم</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <button type="submit" class="btn btn-primary">إضافة تاغ</button>
    </form>
</div>
@endsection
