<!-- Navbar -->
    <nav class="
        navbar navbar-store navbar-expand-lg navbar-light
        fixed-top
        navbar-fixed-top" data-aos="fade-down">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand mt-2">
                <img class="w-50" src="/images/icons/logo.png" alt="logo-image">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collpase navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories') }}" class="nav-link">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Rewards</a>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Sign In</a>
                        </li>
                    @endguest
                </ul>
                @auth
                <ul class="navbar-nav d-none d-lg-flex mb-0">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link" id="navbarDropdown" data-toggle="dropdown" role="button">
                                    <img src="/images/users/linux.png" class="rounded-circle mr-2 profile-picture"
                                        alt="profile-picture"/>
                                    Hi, {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('dashboard') }}" class="dropdown-item">Back to Store</a>
                                    <a href="{{ route('dashboard-setting-account') }}" class="dropdown-item">Settings</a>
                                    <div class="dropdown-divider"></div>
                                    <button type="submit" class="dropdown-item"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </button>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST"   style="display: none">
                                        @csrf    
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                    @php 
                                        $carts = App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                     @endphp
                                     @if($carts > 0)
                                        <img src="/images/icons/ic-cart.svg" alt="icon-carts">
                                        <div class="card-badge">{{$carts}}</div>
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
                                <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                                    @php 
                                        $carts = App\Models\Cart::where('users_id', Auth::user()->id)->count();
                                     @endphp
                                     @if($carts > 0)
                                        <img src="/images/icons/ic-cart.svg" alt="icon-carts">
                                        <div class="card-badge">{{$carts}}</div>
                                    @else
                                         <img src="/images/icons/ic-cart.svg" alt="icon-carts">
                                    @endif
                                </a>
                            </li>
                </ul>
            @endauth            
            </div>
        </div>
    </nav>