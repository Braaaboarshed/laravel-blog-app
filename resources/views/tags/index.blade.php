@extends('layout')

@section('title', 'All Tags')

@section('content')
<div class="container mt-4">
    <h1>التاغات</h1>

    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">إضافة تاغ جديد</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا التاغ؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
