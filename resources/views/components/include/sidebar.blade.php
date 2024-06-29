<div id="scrollbar">
    <div class="container-fluid">
        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Pages</span></li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ Request::is('admin/dashboard', 'admin/dashboard/*') ? 'active' : '' }}"
                    data-key="t-dashboard">
                    <i class="ri-dashboard-2-line"></i> <span>Dashboard</span> </a>
            </li>
            <li class="menu-title"><span data-key="t-menu">Component</span></li>
           
            <li class="nav-item">
                <a href="{{ route('admin.counter.index') }}"
                    class="nav-link {{ Request::is('admin/counter', 'admin/counter/*') ? 'active' : '' }}"
                    data-key="t-counter">
                    <i class="ri-numbers-line"></i> <span>Counter Data</span> </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.events.index') }}"
                    class="nav-link {{ Request::is('admin/events', 'admin/events/*') ? 'active' : '' }}"
                    data-key="t-events">
                    <i class="ri-gallery-upload-line"></i> <span>Events</span> </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.faq.index') }}"
                    class="nav-link {{ Request::is('admin/faq', 'admin/faq/*') ? 'active' : '' }}" data-key="t-faq">
                    <i class="ri-questionnaire-line"></i> <span>Faq</span> </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.gallery-category.index') }}"
                    class="nav-link {{ Request::is('admin/gallery', 'admin/gallery/*') || Request::is('admin/gallery-category', 'admin/gallery-category/*') ? 'active' : '' }}"
                    data-key="t-gallery">
                    <i class="ri-image-line"></i> <span>Gallery</span> </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.posts.index') }}"
                    class="nav-link {{ Request::is('admin/posts', 'admin/posts/*') ? 'active' : '' }}"
                    data-key="t-posts">
                    <i class="ri-file-upload-line"></i> <span>Posts</span> </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.logo-sliders.index') }}"
                    class="nav-link {{ Request::is('admin/logo-sliders', 'admin/logo-sliders/*') ? 'active' : '' }}"
                    data-key="t-logo-slider">
                    <i class=" ri-dashboard-line"></i> <span>Logo Sliders</span> </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.hero-image-sliders.index') }}"
                    class="nav-link {{ Request::is('admin/hero-image-sliders', 'admin/hero-image-sliders/*') ? 'active' : '' }}"
                    data-key="t-hero-image-sliders">
                    <i class=" ri-dashboard-line"></i> <span>Hero Image Sliders</span> </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.heroes.index') }}"
                    class="nav-link {{ Request::is('admin/heroes', 'admin/heroes/*') ? 'active' : '' }}"
                    data-key="t-heroes">
                    <i class=" ri-dashboard-line"></i> <span>Heroes</span> </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.section.index') }}"
                    class="nav-link {{ Request::is('admin/section', 'admin/section/*') ? 'active' : '' }}"
                    data-key="t-section">
                    <i class="ri-layout-column-line"></i> <span>Section</span> </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.testimoni.index') }}"
                    class="nav-link {{ Request::is('admin/testimoni', 'admin/testimoni/*') ? 'active' : '' }}"
                    data-key="t-testimoni">
                    <i class="ri-chat-quote-line"></i> <span>Testimoni</span> </a>
            </li>


            <li class="nav-item">
                <a href="{{ route('admin.videos.index') }}"
                    class="nav-link {{ Request::is('admin/videos', 'admin/videos/*') ? 'active' : '' }}"
                    data-key="t-videos">
                    <i class=" ri-video-line"></i> <span>Videos</span> </a>
            </li>

            @role('Superadmin')
                <li class="menu-title"><span data-key="t-menu">Masters</span></li>
                <li class="nav-item">
                    <a href="{{ route('admin.menu.index') }}"
                        class="nav-link {{ Request::is('admin/menu', 'admin/menu/*') ? 'active' : '' }}"
                        data-key="t-menus">
                        <i class=" ri-menu-2-line"></i> <span>Menus</span> </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ Request::is('admin/users', 'admin/users/*') ? 'active' : '' }}"
                        data-key="t-users">
                        <i class="ri-user-line"></i> <span>Users</span> </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.setting.index') }}"
                        class="nav-link {{ Request::is('admin/setting', 'admin/setting/*') ? 'active' : '' }}"
                        data-key="t-setting">
                        <i class="ri-settings-2-line"></i> <span>Setting</span> </a>
                </li>
            @endrole
        </ul>
    </div>
</div>
