@extends('layouts.admin.admin')

@section('content-title')
    <h1>Edit Order</h1>
@endsection

@section('content-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
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
                                    <div class="col-6">
                                        <h4>Order Information</h4>
                                        <form action="{{ route('admin.shippings.update', $shipping) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" disabled value="{{ $shipping->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" name="email" id="email" disabled value="{{ $shipping->email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" name="address" id="address" disabled value="{{ $shipping->address }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="phone" disabled value="{{ $shipping->phone }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="shipping-service">Shipping Service</label>
                                                <input type="text" class="form-control" name="shipping-service" id="shipping-service" disabled value="{{ $shipping->shipping_service }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="province">Province</label>
                                                <input type="text" class="form-control" name="province" id="province" disabled value="{{ $shipping->destination_details['province'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" name="city" id="city" disabled value="{{ $shipping->destination_details['city_name'] }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="courier">Courier</label>
                                                <input type="text" class="form-control" name="courier" id="courier" disabled value="{{ $shipping->courier }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="zip">Zip</label>
                                                <input type="text" class="form-control" name="zip" id="zip" disabled value="{{ $shipping->zip }}">
                                            </div>
                                            {{-- if member have not pay the orders or payment status is invalid --}}
                                            @if(!optional($shipping->payment)->status || optional($shipping->payment)->status === array_keys(\App\Models\Payment::STATUSES)[1])
                                                <div class="form-group">
                                                    <label for="approve">Approve</label>
                                                    <select class="form-control @error('approve') is-invalid @enderror" name="approve" id="approve">
                                                        <x-nothing-selected></x-nothing-selected>
                                                        @foreach(\App\Models\Payment::STATUSES as $status => $statusName)
                                                            <option @if (old('approve', optional($shipping->payment)->status) === $status) selected @endif value="{{ $status }}">{{ $statusName }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('approve')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            {{-- if member payment is valid --}}
                                            @else
                                                <div class="form-group">
                                                    <label for="tracking_id">Enter tracking ID.</label>
                                                    <input type="text" class="form-control @error('tracking_id') is-invalid @enderror" @if ($shipping->tracking_id) disabled @endif id="tracking_id" name="tracking_id" placeholder="Ex: 0030039xxxxx" value="{{ old('tracking_id', $shipping->tracking_id) }}">
                                                    @if($errors->has('tracking_id'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('tracking_id') }}
                                                        </div>
                                                    @else
                                                        <small class="form-text text-muted">
                                                            @if ($shipping->tracking_id)
                                                                This tracking id will help member to track their orders.
                                                            @else
                                                                Please enter valid tracking id. It's will help member to track their orders. <br> This will display once.
                                                            @endif
                                                        </small>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="shipping_status">Shipping Status</label>
                                                    <select class="form-control @error('shipping_status') is-invalid @enderror" name="shipping_status" id="shipping_status">
                                                        <x-nothing-selected></x-nothing-selected>
                                                        @foreach(\App\Models\Shipping::SHIPPING_STATUSES as $status => $statusName)
                                                            <option @if (old('shipping_status', $shipping->shipping_status) === $status) selected @endif value="{{ $status }}">{{ $statusName }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('shipping_status')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <button class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <h4>Payment Information</h4>
                                        <form action="{{ route('payments.shipping.pay.update', $shipping) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="order-total">Total Order</label>
                                                <input type="text" class="form-control" name="order-total" id="order-total" disabled value="Rp. {{ $shipping->converted_total }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="shipping-total">Total Shipping Cost</label>
                                                <input type="text" class="form-control" name="shipping_total" id="shipping-total" disabled value="Rp. {{ $shipping->converted_cost }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="payment-total">Total Payment To Pay</label>
                                                <input type="text" class="form-control" name="shipping_total" id="payment-total" disabled value="Rp. {{ $shipping->total_payment }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="sender-bank">Member Bank Name</label>
                                                <input type="text" class="form-control" name="sender_bank" id="sender-bank" disabled value="{{ optional($shipping->payment)->sender_bank ?? '-' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="sender-account-number">Member Bank Account Number</label>
                                                <input type="text" class="form-control" name="sender_account_number" id="sender-account-number" disabled value="{{ optional($shipping->payment)->sender_account_number ?? '-' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="merchant-bank">Member Merchant Bank</label>
                                                <input type="text" class="form-control" name="merchant_bank" id="merchant-bank" disabled value="{{ optional($shipping->payment)->merchant_bank ?? '-' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="payment-proof">Payment Proof</label>
                                                @if(optional($shipping->payment)->payment_proof_url)
                                                    <div style="border: 1px dashed #cccccc; border-radius: 5px;">
                                                        <img src="{{ optional($shipping->payment)->payment_proof_url }}" alt="" width="100%" height="100%">
                                                    </div>
                                                @else
                                                    <input type="text" class="form-control" id="payment-proof" disabled value="-">
                                                @endif
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
