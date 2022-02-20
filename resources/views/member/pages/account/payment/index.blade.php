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
                                <th class="col-3">Shipping Service</th>
                                <th class="col-2">Status</th>
                                <th class="col-3">Address</th>
                                <th class="col-2">Courier</th>
                                <th class="col-2">Cost</th>
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
                                        @else
                                            <span class="badge badge-primary">waiting</span>
                                        @endif
                                    </td>
                                    <td>{{ $shipping->address }}</td>
                                    <td>{{ $shipping->courier_full_name }}</td>
                                    <td>Rp. {{ $shipping->converted_cost }}</td>
                                    <td>
                                        <a href="{{ route('payments.shipping.pay.edit', $shipping) }}" class="btn btn-warning"><i class="fa fa-pen"></i></a>
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
