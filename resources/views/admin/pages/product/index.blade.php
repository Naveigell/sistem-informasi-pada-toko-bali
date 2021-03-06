@extends('layouts.admin.admin')

@section('content-title', 'Product')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Product Lists</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> &nbsp; Add Product</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-2">Image</th>
                            <th class="col-2">Name</th>
                            <th class="col-1">Category</th>
                            <th class="col-1">Stock</th>
                            <th class="col-1">Weight</th>
                            <th class="col-2">Price</th>
                            <th class="col-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ (($products->currentPage() - 1) * $products->perPage()) + $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $product->image->url }}" alt="" width="100px;" height="100px;">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <div class="badge badge-success">{{ $product->category->name }}</div>
                                </td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->weight }} gr</td>
                                <td>Rp. {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-action mr-1" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-action trigger--modal-delete cursor-pointer" data-url="{{ route('admin.products.destroy', $product) }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center">Data empty</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Product'"></x-modal.delete>
@endsection
