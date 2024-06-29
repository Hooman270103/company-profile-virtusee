<!-- Header section start -->
<header class="header-section v2 header-style5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg">
                    <div class="container header-navbar-container">
                        <a class="navbar-brand header-logo" href="index.html">
                            <img src="{{ asset('assets') }}/images/logo/logo-primary.svg" alt="header-logo" height="40" />
                        </a>

                        <a id="nav-expander" class="nav-expander bar" href="#">
                            <img src="{{ asset('assets') }}/images/icons/menu.svg" alt="menu" />
                            <img src="{{ asset('assets') }}/images/icons/menu-close.svg" alt="menu" />
                        </a>

                        <div class="collapse navbar-collapse header-navbar-content" id="navbarSupportedContent">
                            <ul class="navbar-nav main-menu">
                              <li><a href="{{ url('/') }}">Home</a></li>
                              <li><a href="{{ route('artificial-intelligence') }}">Artificial Intelligence</a></li>
                              <li><a href="{{ route('fitur') }}">Fitur</a></li>
                              <li><a href="{{ route('penerapan') }}">Penerapan</a></li>
                              <li><a href="{{ route('profile') }}">Profile</a></li>
                              <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
                            </ul>
                            <ul class="header-extra">
                                <li>
                                  <a href="{{ route('login') }}">Masuk</a>
                              </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header section end -->

<!-- Canvas Mobile Menu start -->
<nav class="right_menu_togle mobile-navbar-menu" id="mobile-navbar-menu">
    <ul class="nav-menu">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('artificial-intelligence') }}">Artificial Intelligence</a></li>
        <li><a href="{{ route('fitur') }}">Fitur</a></li>
        <li><a href="{{ route('penerapan') }}">Penerapan</a></li>
        <li><a href="{{ route('profile') }}">Profile</a></li>
        <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
        </ul>
    <ul class="nav-buttons">
        <li>
            <a href="{{ route('login') }}">Masuk</a>
        </li>
    </ul>
</nav>
<!-- Canvas Menu end -->