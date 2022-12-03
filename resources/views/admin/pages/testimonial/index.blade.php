@extends('layouts.admin.admin')

@section('content-title', 'Testimonial')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Testimonial Lists</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> &nbsp; Add Testimonial</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-7">Description</th>
                            <th class="col-2">Star</th>
                            <th class="col-2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($testimonials as $testimonial)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $testimonial->description }}</td>
                                <td>
                                    <span>
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star" @if ($i <= $testimonial->star) style="color: darkorange;" @endif></i>
                                        @endfor
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-primary btn-action mr-1" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-action trigger--modal-delete cursor-pointer" data-url="{{ route('admin.testimonials.destroy', $testimonial) }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center;">Data Empty</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $testimonials->links() }}
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Testimonial'"></x-modal.delete>
@endsection
