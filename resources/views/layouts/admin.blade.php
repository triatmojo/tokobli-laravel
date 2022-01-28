<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    
    <link rel="stylesheet" href="/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/vendors/fontawesome/all.min.css">
    <link rel="stylesheet" href="/assets/css/app.css">


</head>

<body>
    <div id="app"  data-aos="fade-up">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <div class="header-top">
                    <div class="container">
                        <div class="logo-tokobli">
                            <a href="{{ route('dashboard-admin') }}"><img class="w-50" src="/images/icons/logo.png" alt="Logo"></a>
                        </div>
                        <div class="header-top-right">

                            <div class="dropdown">
                                <a href="#" class="user-dropdown d-flex dropend" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2" >
                                        <img src="/assets/images/faces/1.jpg" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        <h6 class="user-dropdown-name">{{ Auth::user()->name }}</h6>
                                        <p class="user-dropdown-status text-sm text-muted">{{ Auth::user()->role == "ADMIN" ? 'Administrator' : 'Member' }}</p>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="dropdownMenuButton1">
                                  <li>
                                      <a class="dropdown-item" href="#">My Account</a>
                                    </li>
                                  <li>
                                      <a class="dropdown-item" href="#">Settings</a>
                                    </li>
                                  <li>
                                      <hr class="dropdown-divider">
                                    </li>
                                  <li>
                                      <a class="dropdown-item" href="{{ route('logout') }}" 
                                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                      Logout
                                    </a>
                                    </li>
                                </ul>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                    @csrf
                                </form>
                            </div> 

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <nav class="main-navbar">
                    <div class="container d-flex justify-content-center">
                        <ul>  
                            <li
                                class="menu-item">
                                <a href="{{ route('dashboard-admin') }}" class="menu-link">
                                    <i class="bi bi-speedometer2"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li
                                class="menu-item">
                                <a href="{{ route('category.index') }}" class='menu-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Categories</span>
                                </a>
                            </li>
                            <li
                                class="menu-item">
                                <a href="{{ route('product.index') }}" class='menu-link'>
                                    <i class="bi bi-cart4"></i>
                                    <span>Products</span>
                                </a>
                            </li>
                            <li
                                class="menu-item">
                                <a href="{{ route('product-gallery.index') }}" class='menu-link'>
                                    <i class="bi bi-images"></i>
                                    <span>Galleries</span>
                                </a>
                            </li>
                            <li
                                class="menu-item">
                                <a href="#" class='menu-link'>
                                    <i class="bi bi-cash"></i>
                                    <span>Transactions</span>
                                </a>
                            </li>
                           
                            <li
                                class="menu-item">
                                <a href="{{ route('user.index') }}" class='menu-link'>
                                    <i class="bi bi-people"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </header>

            {{-- Page Content --}}
            @yield('content')

            <hr>
            <footer>
                <div class="container">
                   <div class="row">
                       <div class="col-12 text-center">
                           <p class="py-4">2021  &copy; tokobli. All Rights Reserved.</p>
                       </div>
                   </div>
                </div>
            </footer>
        </div>
    </div>
@stack('prepand-script')
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init()
</script>

<script src="/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="/assets/js/pages/dashboard.js"></script>

<script src="/assets/js/pages/horizontal-layout.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>
@stack('addon-script')
</body>

</html>
