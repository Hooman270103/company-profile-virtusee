 <!-- Header section start -->
 <header class="header-section v1">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <nav class="navbar navbar-expand-lg">
                  <div class="container header-navbar-container">
                      <a class="navbar-brand header-logo" href="{{ url('/') }}">
                          <img src="{{ $setting['logo_primary'] }}" alt="header-logo" class="logo-light" height="32" />
                          <img src="{{ $setting['logo_secondary'] }}" alt="header-logo" class="logo-dark" height="32"/>
                      </a>
                      <a id="nav-expander" class="nav-expander bar" href="#">
                          <img src="{{ asset('assets_frontend') }}/images/icons/menu.svg" alt="menu" />
                          <img src="{{ asset('assets_frontend') }}/images/icons/menu-close.svg" alt="menu" />
                      </a>

                      <div class="collapse navbar-collapse header-navbar-content" id="navbarSupportedContent">
                          <ul class="navbar-nav main-menu">
                              @if (count($menus) > 0)
                                  @foreach ($menus as $key => $menu)
                                      @if (!$menu['children'])
                                          <li><a class="dropdown-item"
                                                  href="{{ $menu['type'] == 1 ? route('page.display', $menu['slug']) : $menu['link_url'] }}"
                                                  @if ($menu['type'] == 2) target="_blank" @endif>{{ $menu['name'] }}</a>
                                          </li>
                                      @else
                                          <li class="nft-has-submenu">
                                              <a class="dropdown-item" href="#">{{ $menu['name'] }}</a>
                                              <ul class="nft-submenu">
                                                  @foreach ($menu['children'] as $child)
                                                      <li>
                                                          <a href="{{ $child['type'] == 1 ? route('page.display', $child['slug']) : $child['link_url'] }}"
                                                              @if ($child['type'] == 2) target="_blank" @endif>{{ $child['name'] }}</a>
                                                      </li>
                                                  @endforeach
                                              </ul>
                                          </li>
                                      @endif
                                  @endforeach
                              @endif
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
      @if (count($menus) > 0)
          @foreach ($menus as $key => $menu)
              @if (!$menu['children'])
                  <li><a class="dropdown-item"
                          href="{{ $menu['type'] == 1 ? route('page.display', $menu['slug']) : $menu['link_url'] }}"
                          @if ($menu['type'] == 2) target="_blank" @endif>{{ $menu['name'] }}</a>
                  </li>
              @else
                  <li class="dropdown">
                      <a class="dropdown-item" href="#">{{ $menu['name'] }}</a>
                      <ul>
                          @foreach ($menu['children'] as $child)
                              <li>
                                  <a href="{{ $child['type'] == 1 ? route('page.display', $child['slug']) : $child['link_url'] }}"
                                      @if ($child['type'] == 2) target="_blank" @endif>{{ $child['name'] }}</a>
                              </li>
                          @endforeach
                      </ul>
                  </li>
              @endif
          @endforeach
      @endif
  </ul>
</nav>
<!-- Canvas Menu end -->