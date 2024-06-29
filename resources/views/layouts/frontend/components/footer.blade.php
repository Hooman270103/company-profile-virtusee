  <!-- Footer section start -->
  <footer class="footer-section">
    <!-- Footer top start -->
    <div class="footer-top">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-card">
                        <div class="footer-info">
                            <a href="index.html" class="footer-logo">
                                <img src="{{ $setting['logo_secondary'] }}" alt="footer-logo" />
                            </a>
                            <p>
                                {{ $setting['description'] }}
                            </p>
                        </div>
                        <div class="footer-follow">
                            <p>Follow:</p>
                            <ul class="social-link">
                                @if (isset($setting['link_facebook']))
                                    <li>
                                        <a href="{{ $setting['link_facebook'] }}" target="_blank"
                                            ><img src="{{ asset('assets_frontend') }}/images/icons/facebook.svg" alt="social-icon"
                                        /></a>
                                    </li>
                                @endif
                                @if (isset($setting['link_twitter']))
                                    <li>
                                        <a href="{{ $setting['link_twitter'] }}" target="_blank"
                                            ><img src="{{ asset('assets_frontend') }}/images/icons/twitter.svg" alt="social-icon"
                                        /></a>
                                    </li>
                                @endif
                                @if (isset($setting['link_instagram']))
                                    <li>
                                        <a href="{{ $setting['link_instagram'] }}" target="_blank"
                                            ><img src="{{ asset('assets_frontend') }}/images/icons/instagram.svg" alt="social-icon"
                                        /></a>
                                    </li>
                                @endif
                                @if (isset($setting['link_tiktok']))
                                    <li>
                                        <a href="{{ $setting['link_tiktok'] }}" target="_blank"
                                            ><img src="{{ asset('assets_frontend') }}/images/icons/tiktok.svg" alt="social-icon"
                                        /></a>
                                    </li>
                                @endif
                                @if (isset($setting['link_linkedin']))
                                    <li>
                                        <a href="{{ $setting['link_linkedin'] }}" target="_blank"
                                            ><img src="{{ asset('assets_frontend') }}/images/icons/linkedin.svg" alt="social-icon"
                                        /></a>
                                    </li>
                                @endif
                               
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-4 col-6">
                            <aside class="footer-widget">
                                <div class="widget-title">
                                    <h6>Menu</h6>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        @if (count($menus) > 0)
                                            @foreach ($menus as $key => $menu)
                                                @if (!$menu['children'])
                                                    <li><a class="nav-link scrollto"
                                                            href="{{ $menu['type'] == 1 ? route('page.display', $menu['slug']) : $menu['link_url'] }}"
                                                            @if ($menu['type'] == 2) target="_blank" @endif>{{ $menu['name'] }}</a>
                                                    </li>
                                                @else
                                                    <li class="dropdown">
                                                        <a href="#"><span>{{ $menu['name'] }}</span> <i
                                                                class="bi bi-chevron-down"></i></a>
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
                                </div>
                            </aside>
                        </div>

                        <div class="col-md-4 col-6">
                            <aside class="footer-widget">
                                <div class="widget-title">
                                    <h6>Menu</h6>
                                </div>
                                <div class="widget-body">
                                    <ul class="widget-list">
                                        <li><a href="#">FAQ</a></li>
                                    </ul>
                                </div>
                            </aside>
                        </div>
                       
                        
                        <div class="col-md-4 col-6">
                            <aside class="footer-widget">
                                <div class="widget-title">
                                    <h6>Lokasi</h6>
                                </div>
                                <div class="widget-body">
                                    <iframe class="img-fluid" src="{{ $setting['maps_location'] }}" frameborder="2"></iframe>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer top end -->
    <!-- Footer bottom start -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-5 order-md-1 order-2">
                    <div class="footer-copyright">
                        <p class="mb-0">Copyright © 2024 Universitas Gresik</p>
                    </div>
                </div>
                <div class="col-md-7 order-md-2 order-1">
                    <ul class="privacy-menu">
                        <li><a href="{{ route('kebijakan-privasi') }}">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer bottom end -->
</footer>
<!-- Footer section end -->