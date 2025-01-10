@extends('layout')

@section('title', 'All Tags')

@section('content')
<div class="container mt-4">
    <h1>Tags</h1>

    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Add new tag</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline" onsubmit="return confirm('      ؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
