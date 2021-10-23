<!-- ======= Header ======= -->
<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <h1 class="logo me-auto"><a href="index.html">SILADI<span>!</span></a></h1>



      @if (Auth::check())
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link {{ request()->routeIs('index') ? 'active' : '' }}" href="{{ route('index') }}">Home</a></li>
                <li><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang SILADI!</a></li>
                <li><a class="nav-link" href="blog.html">Laporan</a></li>
                <li><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Hubungi Kami</a></li>
                <li class="dropdown"><a href="#"> <i class="bx bx-user"></i><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Laporan Saya</a></li>
                    <hr>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>
                    </li>
                    </ul>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
      @else
        <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
            <li><a class="nav-link scrollto active" href="{{ route('index') }}">Home</a></li>
            <li><a class="nav-link scrollto" href="{{ route('about') }}">Tentang SILADI!</a></li>
            <li><a class="nav-link" href="{{ route('contact') }}">Hubungi Kami</a></li>
            <li><a class="nav-link" href="{{ route('login') }}">MASUK</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

        <a class="get-started-btn" href="{{ route('register') }}">DAFTAR</a>
      @endif
    </div>
  </header><!-- End Header -->
