@extends('layouts.member.account.member')

@section('content-body')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th class="col-1">No</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($shipping->orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img style="width: 150px; height: 150px;" src="{{ $order->product->image->url }}" alt="{{ $order->product->name }}">
                                        </td>
                                        <td>{{ $order->product->name }}</td>
                                        <td>Rp. {{ $order->product->converted_price }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>
                                            @if(!in_array($order->product->id, $reviewsIds))
                                                <a href="{{ route('shippings.products.reviews.create', [$shipping, $order->product]) }}" class="btn btn-warning"><i class="fa fa-star"></i></a>
                                            @else
                                                <button class="btn btn-success"><i class="fa fa-check"></i></button>
                                            @endif
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
