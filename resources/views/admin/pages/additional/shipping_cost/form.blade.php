@extends('layouts.admin.admin')

@section('content-title', 'Create Shipping Cost')

@section('content-body')
    <div class="col-12 col-md-12 col-lg-12 no-padding-margin">
        <div class="card">
            <form action="{{ @$shippingCost ? route('admin.shipping-costs.update', $shippingCost) : route('admin.shipping-costs.store') }}" method="post">
                @csrf
                @if (@$shippingCost)
                    @method('put')
                @endif
                <div class="card-header">
                    <h4>Form Shipping Cost</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Area</label>
                        <input type="text" class="form-control @error('area') is-invalid @enderror" name="area" value="{{ old('area', @$shippingCost ? $shippingCost->area : '') }}">
                        @error('area')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Cost</label>
                        <input type="text" class="form-control @error('cost') is-invalid @enderror" name="cost" value="{{ old('cost', @$shippingCost ? $shippingCost->cost : '') }}">
                        @error('cost')
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
