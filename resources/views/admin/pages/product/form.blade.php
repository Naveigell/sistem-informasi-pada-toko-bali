@extends('layouts.admin.admin')

@section('content-title', 'Create Product')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ @$product ? route('admin.products.update', $product) : route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if (@$product)
                    @method('put')
                @endif
                <div class="card-header">
                    <h4>Form Product</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/png,image/jpeg,image/jpg">
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', @$product ? $product->name : '') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea style="resize: none; height: 200px;" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', @$product ? $product->description : '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" id="" class="form-control">
                            @foreach($categories as $category)
                                <option @if (old('category', @$product ? $product->category->id : '') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', @$product ? $product->stock : '') }}">
                        @error('stock')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" min="1" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', @$product ? $product->price : '') }}">
                        @error('price')
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
