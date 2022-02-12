@extends('layouts.admin.admin')

@section('content-title', 'Shipping Cost')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Shipping Cost Lists</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.shipping-costs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> &nbsp; Add Shipping Cost</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-6">Area</th>
                            <th class="col-3">Cost</th>
                            <th class="col-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($shippingCosts as $shippingCost)
                            <tr>
                                <td>
                                    {{ (($shippingCosts->currentPage() - 1) * $shippingCosts->perPage()) + $loop->iteration }}
                                </td>
                                <td>{{ $shippingCost->area }}</td>
                                <td>Rp{{ $shippingCost->converted_cost }}</td>
                                <td>
                                    <a href="{{ route('admin.shipping-costs.edit', $shippingCost) }}" class="btn btn-primary btn-action mr-1" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-action trigger--modal-delete cursor-pointer" data-url="{{ route('admin.shipping-costs.destroy', $shippingCost) }}"><i class="fas fa-trash"></i></a>
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
                {{ $shippingCosts->links() }}
            </div>
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Shipping Cost'"></x-modal.delete>
@endsection
