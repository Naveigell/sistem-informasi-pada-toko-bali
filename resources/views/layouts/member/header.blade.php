<div class="navbar-bg" style="height: 70px;"></div>
<nav class="navbar navbar-expand-lg main-navbar" style="left: 0;">
    <a href="{{ route('index') }}" class="navbar-brand sidebar-gone-hide">Home</a>
    <form class="form-inline mr-auto">
{{--        <div class="search-element">--}}
{{--            <input class="form-control" value="{{ request('search') }}" name="search" type="search" placeholder="Search ..." aria-label="Search" data-width="400" style="width: 400px;">--}}
{{--            <button class="btn" type="submit"><i class="fas fa-search"></i></button>--}}
{{--        </div>--}}
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown ">
            <a href="{{ route('carts.index') }}" class="nav-link nav-link-lg beep" style="position: relative;">
                <i class="fas fa-shopping-cart"></i>

                @if (auth()->isUser())
                    <span style="position: absolute; font-size: 12px; bottom: 0; right: 0; background: #e51d1d; border-radius: 50px; min-width: 20px; min-height: 20px; line-height: 0; display: flex; justify-content: center; align-items: center;">
                        <span>{{ $carts->count() }}</span>
                    </span>
                @endif
            </a>
        </li>
        @if (auth()->isUser())
            <li class="dropdown">
                <a href="{{ route('payments.index') }}" class="nav-link nav-link-lg nav-link-user">
                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->username }}</div>
                </a>
            </li>
        @else
            <li class="dropdown dropdown-list-toggle">
                <a href="{{ route('login.index') }}" class="nav-link nav-link-lg" style="position: relative;">
                    <i class="fa fa-sign-in-alt"></i>

                    @if (auth()->isUser())
                        <span style="position: absolute; font-size: 12px; bottom: 0; right: 0; background: #e51d1d; border-radius: 50px; min-width: 20px; min-height: 20px; line-height: 0; display: flex; justify-content: center; align-items: center;">
                            <span>{{ $carts->count() }}</span>
                        </span>
                    @endif
                </a>
            </li>
        @endif
    </ul>
</nav>
