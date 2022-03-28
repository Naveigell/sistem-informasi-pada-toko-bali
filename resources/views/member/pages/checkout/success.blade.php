@extends('layouts.member.member')

@push('stack-style')
    <style>
        body {
            background-color: white;
        }
    </style>
@endpush

@section('content-body')
    <div class="container">
        <div class="d-flex justify-content-center">
            <img src="{{ asset('assets/img/checkout-illustration.jpg') }}" alt="" width="40%" height="40%" style="background-color: blue;">
        </div>
        <div class="row text-center">
            <div class="col-12">
                <h2>Order Success!</h2>
            </div>
            <div class="col-12">
                <h6>Thank you for order in our shop.</h6>
            </div>
            <div class="col-12">
                <a href="{{ route('payments.index') }}" class="btn btn-success btn-lg">Go to payment</a>
            </div>
            <div class="col-12 mt-5">
                <span class="text-muted">Author of this illustration : <a target="_blank" href="https://vecteezy.com">Vecteezy.com</a></span>
            </div>
        </div>
    </div>
@endsection
