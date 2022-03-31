@extends('layouts.member.account.member')

@section('content-body')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
            <div class="card">
                <div class="card-header">
                    <h4>Your Suggestion Lists</h4>
                    <div class="card-header-action">
                        <a href="{{ route('suggestions.create') }}" class="btn btn-primary">Add Suggestion</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th class="col-1">No</th>
                                    <th class="col-7">Description</th>
                                    <th class="col-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($suggestions as $suggestion)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $suggestion->description }}</td>
                                        <td>{{ $suggestion->created_at->format('d F Y') }}</td>
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
            </div>
        </div>
    </div>
@endsection
