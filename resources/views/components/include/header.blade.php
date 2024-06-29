<header id="page-topbar">
  <div class="layout-width">
      <div class="navbar-header">
          <div class="d-flex">
              <!-- LOGO -->
              <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets_admin') }}/images/logos/logo-secondary.png" alt="" height="32">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets_admin') }}/images/logos/logo-primary.png" alt="" height="32">
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets_admin') }}/images/logos/logo-secondary.png" alt="" height="32">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets_admin') }}/images/logos/logo-primary.png" alt="" height="32">
                        </span>
                    </a>
              </div>

              <button type="button" class="px-3 btn btn-sm fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none" id="topnav-hamburger-icon">
                  <span class="hamburger-icon">
                      <span></span>
                      <span></span>
                      <span></span>
                  </span>
              </button>
             
          </div>

          <div class="d-flex align-items-center">

              <div class="dropdown d-md-none topbar-head-dropdown header-item">
                  <button type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-search fs-22"></i>
                  </button>
                  <div class="p-0 dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="page-header-search-dropdown">
                      <form class="p-3">
                          <div class="m-0 form-group">
                              <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                  <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>

              <div class="dropdown ms-sm-3 header-item topbar-user">
                  <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="d-flex align-items-center">
                          <span class="text-start ms-xl-2">
                              <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                          </span>
                      </span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                      <!-- item-->
                      <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}!</h6>
                      <form action="{{ route('logout') }}" method="POST" id="submit_logout" >
                        @csrf
                          <a class="dropdown-item" id="btn_logout" type="button"><i class="align-middle mdi mdi-logout text-muted fs-16 me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</header>