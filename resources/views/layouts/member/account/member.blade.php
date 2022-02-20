<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title', 'Sistem Informasi')</title>

    @include('layouts.member.style')
    @stack('stack-style')
</head>
<body>
<div id="app">
    <div class="main-wrapper">
    @include('layouts.member.header')

    <!-- Main Content -->
        <div class="main-content" style="padding-left: 130px; padding-right: 130px;">
            <section class="section">
                <div class="section-body mt-5">
                    <div class="row">
                        <div class="col-3 col-xs-12">
                            @include('layouts.member.account.sidebar')
                        </div>
                        <div class="col-9 col-xs-12">
                            @yield('content-body')
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    @yield('content-modal', '')
</div>

@include('layouts.member.script')
@stack('stack-script')
</body>
</html>
