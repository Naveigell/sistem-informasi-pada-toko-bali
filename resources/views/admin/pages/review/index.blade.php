@extends('layouts.admin.admin')

@section('content-title')
    <h1>Review</h1>
@endsection

@section('content-body')
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
                                <td>{{ $review->star }}</td>
                                <td>{{ $review->description }}</td>
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
