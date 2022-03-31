@extends('layouts.member.account.member')

@section('content-body')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Suggestion</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('suggestions.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea placeholder="Suggestion ..." name="description" id="description" cols="30" rows="10" class="form-control" style="height: 250px; resize: none;"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success"><i class="fa fa-paper-plane"></i> &nbsp;Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
