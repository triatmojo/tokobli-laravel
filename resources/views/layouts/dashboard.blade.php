
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <img src="/images/icons/logo.png" alt="images-logo" class="w-75 my-4">
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('dashboard-product') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard-product*') ? 'active' : '' }}">
                        My Products
                    </a>
                    <a href="{{ route('dashboard-transactions') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard-transactions*') ? 'active' : '' }}" >
                        Transactions
                    </a>
                    <a href="{{ route('dashboard-setting-store') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard-setting-store*') ? 'active' : '' }}">
                        Store Settings
                    </a>
                    <a href="{{ route('dashboard-setting-account') }}" class="list-group-item list-group-item-action {{ request()->is('dashboard-setting-account*') ? 'active' : '' }}">
                        My Account
                    </a>
                </div>
            </div>
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-store navbar-expand-lg navbar-light fixed-top" data-aos="fade-down">
                    <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                        &laquo; Menu
                    </button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-expanded="false">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collpase navbar-collapse" id="navbarSupportedContent">
                        <!-- Desktop Menu -->
                        <ul class="navbar-nav d-none d-lg-flex ml-auto">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link" id="navbarDropdown" data-toggle="dropdown" role="button">
                                    <img src="/images/users/linux.png" class="rounded-circle mr-2 profile-picture"
                                        alt="profile-picture">
                                    Hi, {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('dashboard') }}" class="dropdown-item">Back to Store</a>
                                    <a href="{{ route('dashboard-setting-account') }}" class="dropdown-item">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <a  class="dropdown-item" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                                        Logout
                                    </a>
                                </div>
                                <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                    @php
                                        $carts = App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                    @endphp
                                    @if ($carts > 0)
                                        <img src="/images/icons/ic-cart.svg" alt="icon-carts">
                                        <div class="card-badge">{{ $carts }}</div>
                                    @else
                                        <img src="/images/icons/ic-cart.svg" alt="icon-carts">
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <!-- Mobile Menu -->
                        <ul class="navbar-nav d-block d-lg-none">
                            <li class="nav-item">
                                <a href="#" class="nav-link">Hi, {{ Auth::user()->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                            </li>
                            <li class="nav-item d-inline-block">
                                <a href="{{ route('cart') }}" class="nav-link">
                                    @php
                                        $carts = App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                    @endphp
                                    @if ($carts > 0)
                                        <img src="/images/icons/ic-cart.svg" alt="icon-carts">
                                        <div class="card-badge">{{ $carts }}</div>
                                    @else 
                                        <img src="/images/icons/ic-cart.svg" alt="icon-carts">
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                {{-- Page Content --}}
                @yield('content')
                
            </div>
        </div>
    </div>
    </div>
    @stack('prepend-script')
    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    @stack('addon-script')
</body>

</html>