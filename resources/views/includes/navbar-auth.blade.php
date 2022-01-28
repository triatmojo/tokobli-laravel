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
                    <li class="nav-item active">
                        <a href="{{ route('home') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('categories') }}" class="nav-link">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Rewards</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>