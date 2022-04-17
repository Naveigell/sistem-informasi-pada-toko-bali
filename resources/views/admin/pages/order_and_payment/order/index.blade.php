@extends('layouts.admin.admin')

@section('content-title')
    <h1>Orders</h1>
@endsection

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Order Lists</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-2">Member Name</th>
                            <th class="col-2">Address</th>
                            <th class="col-2">Phone</th>
                            <th class="col-2">Shipping Service</th>
                            <th class="col-2">Shipping Status</th>
                            <th class="col-2">Status</th>
                            <th class="col-1">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($shippings as $shipping)
                            <tr>
                                <td>
                                    {{ (($shippings->currentPage() - 1) * $shippings->perPage()) + $loop->iteration }}
                                </td>
                                <td>{{ $shipping->name }}</td>
                                <td>{{ $shipping->address }}</td>
                                <td>{{ $shipping->phone }}</td>
                                <td>{{ $shipping->shipping_service }}</td>
                                <td>
                                    @if ($shipping->shipping_status)
                                        {{ \App\Models\Shipping::SHIPPING_STATUSES[$shipping->shipping_status] }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if(!optional($shipping->payment)->status && $shipping->payment)
                                        <span class="badge badge-primary">Need to validate payment</span>
                                    @elseif (!optional($shipping->payment)->status)
                                        <span class="badge badge-light">Need to be validated</span>
                                    {{-- if status valid --}}
                                    @elseif(in_array($shipping->payment->status, [array_keys(\App\Models\Payment::STATUSES)[0]]))
                                        <span class="badge badge-success">Valid</span>
                                    {{-- else invalid --}}
                                    @else
                                        <span class="badge badge-danger">Invalid</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- if status valid --}}
                                    @if(optional($shipping->payment)->status === array_keys(\App\Models\Payment::STATUSES)[0])
                                        <a href="{{ route('admin.shippings.edit', $shipping) }}" class="btn btn-success btn-action mr-1" title="" data-original-title="Edit"><i class="fas fa-truck"></i></a>
                                    @else
                                        <a href="{{ route('admin.shippings.edit', $shipping) }}" class="btn btn-warning btn-action mr-1" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center;">Data Empty</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $shippings->links() }}
            </div>
        </div>
    </div>
@endsection
