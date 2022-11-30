@extends('layouts.member.member')

@section('content-body')
    <div class="row">
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <h4>Your Carts</h4>
                    <div class="card-header-action">
                        <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                    </div>
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
                                    <div class="col-2">
                                        Title
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
                                    <div class="col-2">
                                        Aksi
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @foreach($carts as $cart)
                                    <div class="row align-items-center pb-4">
                                        <div class="col-2">
                                            <img width="100px" height="100px" style="border-radius: 7px;" src="{{ $cart->product->image->url }}" alt="">
                                        </div>
                                        <div class="col-2">
                                            {{ $cart->product->name }}
                                        </div>
                                        <div class="col-2 text-center">
                                            {{ $cart->quantity }}
                                        </div>
                                        <div class="col-2 text-center">
                                            Rp{{ $cart->product->converted_price }}
                                        </div>
                                        <div class="col-2 text-center">
                                            Rp{{ number_format($cart->quantity * $cart->product->price, 0, ',', '.') }}
                                        </div>
                                        <div class="col-2 text-center">
                                            <a href="{{ route('products.show', $cart->product) }}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                            <button class="btn btn-danger btn-action trigger--modal-delete cursor-pointer" data-url="{{ route('carts.destroy', $cart) }}"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card card-success">
                <div class="card-header">
                    <h4>Total</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            Total Payment
                        </div>
                        <div class="col-12">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('checkouts.index') }}" class="btn btn-success btn-block">Checkout Now!</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-warning">
                <div class="card-header">
                    <h4>How to pay</h4>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td>1.</td>
                            <td>Click 'checkout now' button.</td>
                        </tr>
                        <tr>
                            <td class="align-top">2.</td>
                            <td>Fill the order form such like address, phone, shipping service, courier.</td>
                        </tr>
                        <tr>
                            <td class="align-top">3.</td>
                            <td>Click 'checkout' button.</td>
                        </tr>
                        <tr>
                            <td class="align-top">4.</td>
                            <td>Go to payment page by click your username on right top navbar.</td>
                        </tr>
                        <tr>
                            <td class="align-top">5.</td>
                            <td>Click the wallet icon to continue to upload your payment proof.</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Item'"></x-modal.delete>
@endsection
