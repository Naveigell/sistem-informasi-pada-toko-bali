
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Posts &mdash; Stisla</title>

    @include('layouts.admin.style')
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        @include('layouts.admin.header')
        @include('layouts.admin.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('content-title', '')</h1>
                </div>
                <div class="section-body">

                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
            </div>
            <div class="footer-right">
                2.3.0
            </div>
        </footer>
    </div>
</div>

@include('layouts.admin.script')
</body>
</html>
