@extends('layouts.admin.admin')

@section('content-title')
    <h1>Review</h1>
@endsection

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Review Lists</h4>
            </div>
            <div class="card-body p-0">
                <div class="">
                    <table class="table table-striped mb-0 table-responsive">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-2">Image</th>
                            <th class="col-2">Product</th>
                            <th class="col-1">User</th>
                            <th class="col-1">Star</th>
                            <th class="col-2">Description</th>
                            <th class="col-1">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($reviews as $review)
                            <tr>
                                <td>{{ (($reviews->currentPage() - 1) * $reviews->perPage()) + $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $review->product->image->url }}" alt="" width="100px;" height="100px;">
                                </td>
                                <td>{{ $review->product->name }}</td>
                                <td>
                                    {{ $review->user->name }}
                                </td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star" @if ($i <= $review->star) style="color: darkorange;" @endif></i>
                                    @endfor
                                </td>
                                <td>{{ $review->description }}</td>
                                <td>
                                    <button data-url="{{ route('admin.reviews.testimonial.store', $review) }}" class="btn btn-primary btn-action mr-1 btn-add" title="" data-toggle="modal" data-target="#modal-add" data-original-title="Edit"><i class="fas fa-plus"></i> Testimonial</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center">Data empty</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.base id="modal-add" method="post" title="Add to testimonial">
        <x-slot name="body">
            <div>
                This action cannot be <span class="text text-danger">undone</span>
            </div>
        </x-slot>
    </x-modal.base>
@endsection

@push('stack-script')
    <script>
        $('.btn-add').on('click', function () {
            $('#modal-add').find('#modal-form').attr('action', $(this).data('url'));
        })
    </script>
@endpush
