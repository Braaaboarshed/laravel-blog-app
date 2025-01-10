@extends('layout')

@section('title', 'Edit User Profile')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Edit User Profile</h3>
        </div>
        <div class="card-body">
            <!--    -->
            <form action="{{ route('user.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!--     PUT  -->

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <!-- Role -->
                <div class="mb-3">
                    <label for="is_admin" class="form-label">Role</label>
                    <select name="is_admin" id="is_admin" class="form-control" required>
                        <option value="user" {{ $user->is_admin == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->is_admin == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Leave blank if not changing">
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                </div>

                <!-- Profile Picture -->
                <div class="mb-3">
                    <label for="image" class="form-label">Change Profile Picture</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</div>
@endsection
