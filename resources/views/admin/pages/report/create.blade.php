@extends('layouts.admin.admin')

@section('content-title', 'Print Report')

@section('content-body')
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Print</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.report.print') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="from">From</label>
                            <input type="date" name="from" class="form-control @error('from') is-invalid @enderror" id="from" value="{{ old('from') }}">
                            @error('from')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="to">To</label>
                            <input type="date" name="to" class="form-control @error('to') is-invalid @enderror" id="to" value="{{ old('to') }}">
                            @error('to')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-12">
                            <button class="btn btn-success btn-md">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
