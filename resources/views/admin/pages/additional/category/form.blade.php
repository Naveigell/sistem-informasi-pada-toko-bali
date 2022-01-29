@extends('layouts.admin.admin')

@section('content-title', 'Create Category')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ @$category ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="post">
                @csrf
                @if (@$category)
                    @method('put')
                @endif
                <div class="card-header">
                    <h4>Form Category</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', @$category ? $category->name : '') }}">
                        @error('name')
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
