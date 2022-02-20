<div class="navbar-bg" style="height: 70px;"></div>
<nav class="navbar navbar-expand-lg main-navbar" style="left: 0;">
    <form class="form-inline mr-auto">
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="400" style="width: 400px;">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
                <div class="search-header">
                    Histories
                </div>
                <div class="search-item">
                    <a href="#">How to hack NASA using CSS</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-item">
                    <a href="#">Kodinger.com</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-item">
                    <a href="#">#Stisla</a>
                    <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>
                <div class="search-header">
                    Result
                </div>
                <div class="search-item">
                    <a href="#">
                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-3-50.png" alt="product">
                        oPhone S9 Limited Edition
                    </a>
                </div>
                <div class="search-item">
                    <a href="#">
                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-2-50.png" alt="product">
                        Drone X2 New Gen-7
                    </a>
                </div>
                <div class="search-item">
                    <a href="#">
                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-1-50.png" alt="product">
                        Headphone Blitz
                    </a>
                </div>
                <div class="search-header">
                    Projects
                </div>
                <div class="search-item">
                    <a href="#">
                        <div class="search-icon bg-danger text-white mr-3">
                            <i class="fas fa-code"></i>
                        </div>
                        Stisla Admin Template
                    </a>
                </div>
                <div class="search-item">
                    <a href="#">
                        <div class="search-icon bg-primary text-white mr-3">
                            <i class="fas fa-laptop"></i>
                        </div>
                        Create a new Homepage Design
                    </a>
                </div>
            </div>
        </div>
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
                    <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                    <div class="d-sm-none d-lg-inline-block">Hi, Ujang Maman</div>
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
