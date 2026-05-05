@extends('layouts.app')

@section('content')
<div class="card shadow-sm max-w-md mx-auto" style="max-width: 600px;">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">Edit User: {{ $user->name }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="cnic" class="form-label">CNIC <span class="text-danger">*</span></label>
                <input type="text" name="cnic" id="cnic" class="form-control" value="{{ old('cnic', $user->cnic) }}" required>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Telephone <span class="text-danger">*</span></label>
                <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $user->telephone) }}" required>
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                @if($user->profile_picture)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Current Picture" width="80" class="img-thumbnail">
                    </div>
                @endif
                <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
                <small class="text-muted">Leave blank to keep the current picture.</small>
            </div>

            <div class="mb-3">
                <label for="comments" class="form-label">Comments</label>
                <textarea name="comments" id="comments" rows="3" class="form-control">{{ old('comments', $user->comments) }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-warning">Update User</button>
            </div>
        </form>
    </div>
</div>
@endsection
