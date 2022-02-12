
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
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
                    @yield('content-body')
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
