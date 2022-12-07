@extends('layouts.member.account.member')

@section('content-body')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            @if ($message = session()->get('avatar-success'))
                                <x-alert.success :message="$message"></x-alert.success>
                            @endif
                            <div class="card">
                                <div class="card-header">
                                    <h4>Avatar</h4>
                                </div>
                                <div class="card-body text text-center">
                                    <div class="position-relative">
                                        <i id="remove-avatar" class="fa fa-times position-absolute text text-danger" style="font-size: 20px; cursor: pointer;"></i>
                                        <img src="{{ $biodata->avatar_url }}" alt="" class="rounded-circle" style="width: 200px; height: 200px;">
                                    </div>
                                    <br>
                                    <button class="btn btn-primary" id="avatar-change">Change</button>
                                    <form id="avatar-form" action="{{ route('biodatas.avatar') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="avatar" class="d-none" id="avatar-input-file" accept="image/png,image/jpeg,image/jpg" readonly>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            @if ($message = session()->get('success'))
                                <x-alert.success :message="$message"></x-alert.success>
                            @endif
                            <div class="card">
                                <form action="{{ route('biodatas.store') }}" method="post">
                                    @csrf
                                    <div class="card-header">
                                        <h4>Biodata</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" id="name" value="{{ old('name', $biodata->name) }}" name="name" class="form-control @error('name') is-invalid @enderror">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" id="username" value="{{ old('username', $biodata->username) }}" name="username" class="form-control @error('username') is-invalid @enderror">
                                            @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="text" id="email" value="{{ old('email', $biodata->email) }}" name="email" class="form-control @error('email') is-invalid @enderror">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-md btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-5">
                            @if ($message = session()->get('success-password'))
                                <x-alert.success :message="$message"></x-alert.success>
                            @endif
                            <div class="card">
                                <form action="{{ route('biodatas.password') }}" method="post">
                                    @csrf
                                    <div class="card-header">
                                        <h4>Password</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="old-password">Old Password</label>
                                            <input type="password" id="old-password" name="old_password" class="form-control @error('old_password') is-invalid @enderror">
                                            @error('old_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="new-password">New Password</label>
                                            <input type="password" id="new-password" name="password" class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="repeat-new-password">Repeat New Password</label>
                                            <input type="password" id="repeat-new-password" name="retype_password" class="form-control @error('retype_password') is-invalid @enderror">
                                            @error('retype_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-md btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('stack-script')
    <script>
        $('#avatar-change').on('click', function () {
            $('#avatar-input-file').click();
        })

        $('#avatar-input-file').change(function () {
            $('#avatar-form').submit();
        });

        $('#remove-avatar').on('click', function () {
            $('#avatar-form').submit();
        });
    </script>
@endpush
