@extends('layouts.member.member')

@push('stack-style')
    <style>
        body {
            background: white;
        }
    </style>
@endpush

@section('content-body')
    <div class="row">
        <div class="col-4">
            <img
                src="{{ $product->image->url }}"
                width="100%"
                height="300px"
                style="border-radius: 19px;"
                alt="Image">
        </div>
        <div class="col-6">
            @if ($message = session()->get('success'))
                <x-alert.success :message="$message"></x-alert.success>
            @endif
            <h4>{{ $product->name }}</h4>
            <span style="font-size: 22px;">Rp{{ $product->converted_price }}</span>
            <hr>
            <p>
                {!! nl2br(e($product->description)) !!}
            </p>
            <hr>
            <form action="{{ route('carts.store') }}" method="post">
                @csrf
                <input type="text" hidden value="{{ $product->id }}" name="product_id">
                @if (auth()->check())
                    <div class="row">
                        <div class="col-1">
                            <button id="decrement" type="button" class="btn btn-primary"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="col-2">
                            <input id="quantity" class="form-control" type="text" value="1" name="quantity">
                        </div>
                        <div class="col-1">
                            <button id="increment" type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-1">
                            <button type="button" disabled class="btn btn-primary"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="col-2">
                            <input class="form-control" disabled type="text" value="1" name="quantity">
                        </div>
                        <div class="col-1">
                            <button type="button" disabled class="btn btn-primary"><i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-8">
                            <button type="button" disabled class="btn btn-success"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                            <span class="text-muted">&nbsp;&bull;&nbsp;Please login to order!</span>
                        </div>
                    </div>
                @endif
                <div class="row mt-2">
                    <div class="col-12">
                        <span>Stock • {{ $product->stock }} buah</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Review</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        @foreach($product->reviews as $review)
                            <li class="media">
                                <img class="mr-3" src="https://getstisla.com/dist/img/example-image-50.jpg" alt="Generic placeholder image">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">{{ $review->user->username }}</h5>
                                    <span>
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star" @if ($i <= $review->star) style="color: darkorange;" @endif></i>
                                        @endfor
                                    </span>
                                    <p>
                                        {{ $review->description }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stack-script')
    <script>
        const quantity = $('#quantity');

        $('#decrement').on('click', function () {
            quantity.val(Math.max(1, parseInt(quantity.val()) - 1));
        });

        $('#increment').on('click', function () {
            quantity.val(Math.min(parseInt(quantity.val()) + 1, {{ $product->stock }}));
        });

        quantity.on('keyup', function (evt) {
            let value = parseInt(evt.target.value);

            if (!isNaN(value)) {
                quantity.val(value);
            } else if (value === '') {

            } else {
                quantity.val(1);
            }
        })
    </script>
@endpush
