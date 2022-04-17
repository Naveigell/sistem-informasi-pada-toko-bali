@extends('layouts.member.member')

@section('content-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Orders</h4>
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
                                    <div class="col-6">
                                        <h4>Order Information</h4>
                                        <form action="">
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
                                                <input type="text" class="form-control" name="province" id="province" disabled value="{{ $shipping->destination_details ? $shipping->destination_details['province'] : '-' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" name="city" id="city" disabled value="{{ $shipping->destination_details ? $shipping->destination_details['city_name'] : $shipping->area->area }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="courier">Courier</label>
                                                <input type="text" class="form-control" name="courier" id="courier" disabled value="{{ $shipping->courier ?? 'Our Courier' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="zip">Zip</label>
                                                <input type="text" class="form-control" name="zip" id="zip" disabled value="{{ $shipping->zip ?? '-' }}">
                                            </div>
                                            @if ($shipping->payment && $shipping->shipping_status)
                                                <div class="form-group">
                                                    <label for="delivery_status">Delivery Status</label>
                                                    <div class="mt-3">
                                                        <i class="fa fa-truck" style="font-size: 180px;"></i>
                                                    </div>
                                                    <div class="mt-4">
                                                        <span class="badge badge-success">{{ \App\Models\Shipping::SHIPPING_STATUSES[$shipping->shipping_status] }}</span>
                                                    </div>
                                                </div>
                                            @endif
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
                                            @if(!$shipping->payment || optional($shipping->payment)->status === array_keys(\App\Models\Payment::STATUSES)[1])
                                                <div class="form-group">
                                                    <label for="sender-bank">Your Bank Name</label>
                                                    <input type="text" class="form-control @error('sender_bank') is-invalid @enderror" name="sender_bank" id="sender-bank" placeholder="Ex. BRI, BCA">
                                                    @error('sender_bank')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="sender-account-number">Your Bank Account Number</label>
                                                    <input type="text" class="form-control @error('sender_account_number') is-invalid @enderror" name="sender_account_number" id="sender-account-number" placeholder="Ex. 1733019xxxx">
                                                    @error('sender_account_number')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="merchant-bank">Choose Bank To Send</label>
                                                    <select type="text" class="form-control @error('merchant_bank') is-invalid @enderror" name="merchant_bank" id="merchant-bank">
                                                        <x-nothing-selected></x-nothing-selected>
                                                        @foreach(\App\Models\Payment::BANK_ACCOUNT as $bank => $account)
                                                            <option value="{{ $bank }}">{{ $account }} {!! str_repeat('&nbsp;', 3) !!} ({{ strtoupper($bank) }})</option>
                                                        @endforeach
                                                    </select>
                                                    @error('merchant_bank')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="payment-proof">Payment Upload</label>
                                                    <input type="file" class="form-control @error('payment_proof') is-invalid @enderror" id="payment-proof" name="payment_proof">
                                                    @error('payment_proof')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <button class="btn btn-success" type="submit">Submit Payment</button>
                                            @else
                                                <div class="form-group">
                                                    <label for="sender-bank">Your Bank Name</label>
                                                    <input type="text" class="form-control" name="sender_bank" id="sender-bank" disabled value="{{ $shipping->payment->sender_bank }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="sender-account-number">Your Bank Account Number</label>
                                                    <input type="text" class="form-control" name="sender_account_number" id="sender-account-number" disabled value="{{ $shipping->payment->sender_account_number }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="merchant-bank">Merchant Bank</label>
                                                    <input type="text" class="form-control" name="merchant_bank" id="merchant-bank" disabled value="{{ $shipping->payment->merchant_bank }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="payment-proof">Payment Proof</label>
                                                    <div style="border: 1px dashed #cccccc; border-radius: 5px;">
                                                        <img src="{{ $shipping->payment->payment_proof_url }}" alt="" width="100%" height="100%">
                                                    </div>
                                                </div>
                                            @endif
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
    <input type="file" multiple="multiple" class="dz-hidden-input" style="visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;">
@endsection

