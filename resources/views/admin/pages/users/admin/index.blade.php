@extends('layouts.admin.admin')

@section('content-title', 'Admin')

@section('content-body')
    @if ($message = session()->get('success'))
        <x-alert.success :message="$message"></x-alert.success>
    @endif
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Admin Lists</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-4">Name</th>
                            <th class="col-3">Username</th>
                            <th class="col-4">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($admins as $admin)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>{{ $admin->email }}</td>
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
        </div>
    </div>
@endsection

@section('content-modal')
    <x-modal.delete :name="'Category'"></x-modal.delete>
@endsection
