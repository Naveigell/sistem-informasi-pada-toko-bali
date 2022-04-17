@extends('layouts.admin.admin')

@section('content-title', 'Create Admin')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ route('admin.admins.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                    <h4>Form Admin</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" id="" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}">
                            <x-nothing-selected></x-nothing-selected>
                            <option @if (old('role') === \App\Models\User::ROLE_OWNER) selected @endif value="{{ \App\Models\User::ROLE_OWNER }}">{{ ucwords(\App\Models\User::ROLE_OWNER) }}</option>
                            <option @if (old('role') === \App\Models\User::ROLE_ADMIN) selected @endif value="{{ \App\Models\User::ROLE_ADMIN }}">{{ ucwords(\App\Models\User::ROLE_ADMIN) }}</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
