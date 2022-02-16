@extends('layouts.member.member')

@push('stack-style')
    <style>
        .selectgroup-button {
            height: 130px;
        }

        .selectgroup span {
            display: block;
            text-align: left;
        }
    </style>
@endpush

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
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Ex: Jln Raya ..." value="{{ old('address') }}">
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Ex: 081234" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="shipping-service">Shipping Service</label>
                            <select name="shipping_service" id="shipping-service" class="form-control @error('shipping_service') is-invalid @enderror">
                                <option value="">-- Nothing Selected --</option>
                                <option value="regular">Reguler</option>
                                <option value="our-courier">Our Courier</option>
                            </select>
                            @error('shipping_service')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-row" id="reguler-container">
                            <div class="form-group col-6">
                                <label for="province">Province</label>
                                <select name="province" id="province" class="form-control @error('province') is-invalid @enderror">
                                    <option value="">-- Nothing Selected --</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                    @endforeach
                                </select>
                                @error('province')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="city">City</label>
                                <select name="city" id="city" class="form-control @error('city') is-invalid @enderror">
                                    <option value="">-- Nothing Selected --</option>
                                </select>
                                @error('city')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="courier">Courier</label>
                                <select name="courier" id="courier" class="form-control @error('courier') is-invalid @enderror">
                                    <option value="">-- Nothing Selected --</option>
                                    @foreach($couriers as $courierAlias => $courierName)
                                        <option value="{{ $courierAlias }}">{{ $courierName }}</option>
                                    @endforeach
                                </select>
                                @error('courier')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="zip">Zip</label>
                                <input type="text" name="zip" class="form-control @error('zip') is-invalid @enderror" id="zip" placeholder="Ex: 81234" value="{{ old('zip') }}">
                                @error('zip')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label for="shipping-type">Shipping Cost</label>
                                <select name="shipping_type" id="shipping-type" class="form-control @error('shipping_type') is-invalid @enderror">
                                    <option value="">-- Nothing Selected --</option>
                                </select>
                                @error('shipping_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row" id="our-courier-container">
                            <div class="form-group col-6">
                                <label for="area_id">Area</label>
                                <select name="area_id" id="area_id" class="form-control @error('area_id') is-invalid @enderror">
                                    <option value="" data-cost="0">-- Nothing Selected --</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}" data-cost="{{ number_format($area->cost, 0, ',', '.') }}">{{ $area->area }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('area_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('area_id') }}
                                    </div>
                                @else
                                    <small id="help-area" class="form-text text-muted">
                                        Please ensure your area is covered.
                                    </small>
                                @endif
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
        $('#reguler-container').hide();

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
            if ($('#courier').existsWithValue()) {
                calculateShippingCost($(this).val(), $('#courier').val());
            }
        });

        $('#courier').on('change', function () {
            if ($('#city').existsWithValue()) {
                calculateShippingCost($('#city').val(), $(this).val());
            }
        });

        function calculateShippingCost(city, courier) {
            $.ajax({
                url: `/shipping-cost/cost/${city}/courier/${courier}`,
                method: 'GET',
                success: function (results){
                    $('#shipping-type').empty();

                    for (const cost in results[0].costs) {

                        if (!results[0].costs.hasOwnProperty(cost))
                            continue;

                        let estimationDate = String(results[0].costs[cost].cost[0].etd).replace(' HARI', '') + ' day';

                        $('#shipping-type').append(`<option value="${cost}">${results[0].costs[cost].service} - ${results[0].costs[cost].description} (Rp. ${convertNumberWithDot(results[0].costs[cost].cost[0].value)})&nbsp;&nbsp;[Etd: ${estimationDate}]</option>`)
                    }
                },
                error: function (result) {
                    console.error(result)
                }
            });
        }
    </script>
@endpush





