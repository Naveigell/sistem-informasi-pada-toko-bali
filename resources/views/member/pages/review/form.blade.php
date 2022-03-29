@extends('layouts.member.account.member')

@push('stack-style')
    <style>
        .star-active {
            color: #f37809;
        }
    </style>
@endpush

@section('content-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Product</h4>
                </div>
                <div class="collapse show" id="mycard-collapse" style="">
                    <div class="card-body">
                        @if ($message = session()->get('success'))
                            <x-alert.success :message="$message"></x-alert.success>
                        @endif
                        <div class="card card-warning">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-2">
                                        Image
                                    </div>
                                    <div class="col-4">
                                        Product Name
                                    </div>
                                    <div class="col-2">
                                        Quantity
                                    </div>
                                    <div class="col-2">
                                        Price Per Pcs
                                    </div>
                                    <div class="col-2">
                                        Total Price
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @foreach($shipping->orders as $order)
                                    <div class="row align-items-center pb-4">
                                        <div class="col-2">
                                            <img width="100px" height="100px" style="border-radius: 7px;" src="{{ $order->product->image->url }}" alt="">
                                        </div>
                                        <div class="col-4">
                                            {{ $order->product->name }}
                                        </div>
                                        <div class="col-2 text-center">
                                            {{ $order->quantity }}
                                        </div>
                                        <div class="col-2 text-center">
                                            Rp{{ $order->product->converted_price }}
                                        </div>
                                        <div class="col-2 text-center">
                                            Rp{{ number_format($order->quantity * $order->product->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row mt-5">
                                    <div class="col-12">
                                        <h6>Product Review</h6>
                                        <form action="{{ route('shippings.products.reviews.store', [$shipping, $product]) }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                @for($i = 0; $i < 5; $i++)
                                                    <i class="fa fa-star star" style="font-size: 40px; padding: 1px; cursor: pointer;"></i>
                                                @endfor
                                                <br>
                                                <input type="hidden" id="star" name="star" class="form-control @error('star') is-invalid @enderror">
                                                @error('star')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea placeholder="Write minimum 10 words..." name="description" id="" cols="30" rows="10" style="height: 250px; resize: none;" class="form-control @error('description') is-invalid @enderror"></textarea>
                                                @error('description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success"><i class="fa fa-paper-plane"></i> &nbsp;Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stack-script')
    <script>
        $('.star').on('click', function () {
            let elementIndex = $(this).index();

            $('#star').val(elementIndex + 1);

            $('.star').removeClass('star-active');

            $('.star').each(function (index) {
                if (index <= elementIndex) {
                    $(this).addClass('star-active');
                }
            })
        });
    </script>
@endpush
