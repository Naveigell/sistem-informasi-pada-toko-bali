@extends('layouts.admin.admin')

@section('content-title', 'Testimonial')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ @$testimonial ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" method="post">
                @csrf
                @if (@$testimonial)
                    @method('put')
                @endif
                <div class="card-header">
                    <h4>Form Testimonial</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror" style="height: 200px;">{{ old('description', @$testimonial ? $testimonial->description : '') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Star</label>
                        <input type="number" class="form-control @error('star') is-invalid @enderror" name="star" value="{{ old('star', @$testimonial ? $testimonial->star : '') }}">
                        @error('star')
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
