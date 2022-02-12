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
                src="https://media-cdn.tripadvisor.com/media/photo-s/18/1c/30/b4/photo1jpg.jpg"
                width="100%"
                height="80%"
                style="border-radius: 19px;"
                alt="Image">
        </div>
        <div class="col-6">
            @if ($message = session()->get('success'))
                <x-alert.success :message="$message"></x-alert.success>
            @endif
            <h4>Baju pemuda pancasila bekas yang sudah pernah di pakai oleh ketuanya</h4>
            <span style="font-size: 22px;">Rp6.000</span>
            <hr>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci asperiores aspernatur corporis dolores nam nesciunt nisi obcaecati, quia quibusdam quidem quos suscipit voluptatum. Amet culpa cumque facere reiciendis repudiandae!
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium adipisci asperiores aspernatur corporis dolores nam nesciunt nisi obcaecati, quia quibusdam quidem quos suscipit voluptatum. Amet culpa cumque facere reiciendis repudiandae!
            </p>
            <hr>
            <form action="{{ route('carts.store') }}" method="post">
                @csrf
                <input type="text" hidden value="{{ $product->id }}" name="product_id">
                @if (auth()->check())
                    <div class="row">
                        <div class="col-1">
                            <button type="button" class="btn btn-primary"><i class="fa fa-minus"></i></button>
                        </div>
                        <div class="col-2">
                            <input class="form-control" type="text" value="1" name="quantity">
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
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
                        <span>Stock • 500 buah</span>
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
                        <li class="media">
                            <img class="mr-3" src="https://getstisla.com/dist/img/example-image-50.jpg" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">Username</h5>
                                <span>
                                <i class="fa fa-star" style="color: darkorange;"></i>
                                <i class="fa fa-star" style="color: darkorange;"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus oringilla. Donec lacinia congue felis in faucibus.</p>
                            </div>
                        </li>
                        <li class="media my-2">
                            <img class="mr-3" src="https://getstisla.com/dist/img/example-image-50.jpg" alt="Generic placeholder image">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1">Username</h5>
                                <span>
                                <i class="fa fa-star" style="color: darkorange;"></i>
                                <i class="fa fa-star" style="color: darkorange;"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                                <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus oringilla. Donec lacinia congue felis in faucibus.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
