@extends('layouts.member.member')

@section('content-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Checkout</h4>
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
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                @dump($errors->all())
                <div class="card-header">
                    <h4>Shipping Address</h4>
                </div>
                <form action="{{ route('checkouts.store') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input disabled type="text" class="form-control" id="name" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input disabled type="email" class="form-control" id="email" value="{{ auth()->user()->email }}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" placeholder="Ex: Jln Raya ...">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="Ex: 081234">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipping-service">Shipping Service</label>
                            <select name="shipping_service" id="shipping-service" class="form-control">
                                <option value="">-- Nothing Selected --</option>
                                <option value="regular">Reguler</option>
                                <option value="our-courier">Our Courier</option>
                            </select>
                        </div>
                        <div class="form-row" id="reguler-container">
                            <div class="form-group col-6">
                                <label for="province">Province</label>
                                <select name="province" id="province" class="form-control">
                                    <option value="">-- Nothing Selected --</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="city">City</label>
                                <select name="city" id="city" class="form-control">
                                    <option value="">-- Nothing Selected --</option>
                                    <option value="reguler">Bali</option>
                                    <option value="cod">Jawa Timur</option>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="courier">Courier</label>
                                <select name="courier" id="courier" class="form-control">
                                    <option value="">-- Nothing Selected --</option>
                                    @foreach($couriers as $courierAlias => $courierName)
                                        <option value="{{ $courierAlias }}">{{ $courierName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="zip">Zip</label>
                                <input type="text" class="form-control" id="zip" placeholder="Ex: 81234">
                            </div>
                            <div class="form-group col-12">
                                <label for="shipping-cost">Shipping Cost</label>
                                <input type="text" class="form-control" id="shipping-cost" value="0" disabled>
                            </div>
                        </div>
                        <div class="form-row" id="our-courier-container">
                            <div class="form-group col-6">
                                <label for="area_id">Area</label>
                                <select name="area_id" id="area_id" class="form-control">
                                    <option value="" data-cost="0">-- Nothing Selected --</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}" data-cost="{{ number_format($area->cost, 0, ',', '.') }}">{{ $area->area }}</option>
                                    @endforeach
                                </select>
                                <small id="help-area" class="form-text text-muted">
                                    Please ensure your area is covered.
                                </small>
                            </div>
                            <div class="form-group col-6">
                                <label for="our-courier-cost">Shipping Cost</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Rp.
                                        </div>
                                    </div>
                                    <input type="text" class="form-control pe-none" id="our-courier-cost" value="0">
                                </div>
                            </div>
                        </div>
                        <br><br>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-lg btn-success btn-block">Checkout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('stack-script')
    <script>
        $('#shipping-service').on('change', function (e) {
            if (e.target.value === 'our-courier') {
                $('#reguler-container').hide();
                $('#our-courier-container').show();
            } else if (e.target.value === 'regular') {
                $('#reguler-container').show();
                $('#our-courier-container').hide();
            } else {
                $('#our-courier-container').hide();
                $('#reguler-container').hide();
            }
        });

        $('#area_id').on('change', function (e) {
            $('#our-courier-cost').val($(this).find(':selected').data('cost'));
        });

        $('#our-courier-container').hide();
        $('#reguler-container').show();

        $('#province').on('change', function () {
            $.ajax({
                url: '/shipping-cost/province/' + $(this).val() + '/cities',
                method: 'GET',
                success: function (cities){
                    $('#city').empty();

                    $('#city').append(`<option>-- Nothing Selected --</option>`);

                    for (const city of cities) {
                        $('#city').append(`<option value="${city.city_id}">${city.type} ${city.city_name}</option>`)
                    }
                },
                error: function (result) {
                    console.error(result)
                }
            });
        });

        $('#city').on('change', function () {
            $.ajax({
                url: '/shipping-cost/cost/' + $(this).val(),
                method: 'GET',
                success: function (result){
                    console.log(result);
                },
                error: function (result) {
                    console.error(result)
                }
            });
        });
    </script>
@endpush





