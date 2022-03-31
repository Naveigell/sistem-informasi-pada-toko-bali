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
                <h4>Suggestion Lists</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-2">User</th>
                            <th class="col-6">Description</th>
                            <th class="col-3">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($suggestions as $suggestion)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $suggestion->user->name }}</td>
                                    <td>{{ $suggestion->description }}</td>
                                    <td>{{ $suggestion->created_at->format('d F Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
