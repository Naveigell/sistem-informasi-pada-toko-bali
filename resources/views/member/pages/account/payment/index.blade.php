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
                                <th class="col-1">Shipping Service</th>
                                <th class="col-2">Status</th>
                                <th class="col-2">Tracking Id</th>
                                <th class="col-3">Address</th>
                                <th class="col-2">Courier</th>
                                <th class="col-3">Cost</th>
                                <th class="col-2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($shippings as $shipping)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $shipping->shipping_service }}</td>
                                    <td>
                                        @if (!$shipping->payment)
                                            <span class="badge badge-danger">unpaid</span>
                                        @elseif ($shipping->shipping_status)
                                            @if($shipping->shipping_status)
                                                <span class="badge badge-success">{{ \App\Models\Shipping::SHIPPING_STATUSES[$shipping->shipping_status] }}</span>
                                            @endif
                                        @else
                                            <span class="badge badge-primary">waiting</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($shipping->payment)
                                            {{ $shipping->tracking_id ?? '-' }}
                                        @endif
                                    </td>
                                    <td>{{ $shipping->address }}</td>
                                    <td>{{ $shipping->courier_full_name }}</td>
                                    <td>Rp. {{ $shipping->converted_cost }}</td>
                                    <td>
                                        @if ($shipping->shipping_service)
                                            <a href="{{ route('shippings.edit', $shipping) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                        @else
                                            <a href="{{ route('payments.shipping.pay.edit', $shipping) }}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center;">Data Empty</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
