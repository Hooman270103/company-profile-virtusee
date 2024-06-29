<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="corporate" data-theme-colors="corporate">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

         <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets_admin') }}/images/logos/Favicon.png">

        <!-- Layout config Js -->
        <script src="{{ asset('assets_admin') }}/js/layout.js"></script>
        <!-- Bootstrap Css -->
        <link href="{{ asset('assets_admin') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('assets_admin') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('assets_admin') }}/css/app.min.css" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="{{ asset('assets_admin') }}/css/custom.min.css" rel="stylesheet" type="text/css" />
        

        <!-- Scripts -->
        
    </head>
    <body>
        <div  class="auth-page-wrapper pt-5">
            <!-- auth page bg -->
            <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
                <div class="bg-overlay"></div>

                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <div class="auth-page-content">
                {{ $slot }}
            </div>
        </div>
    </body>

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets_admin') }}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets_admin') }}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('assets_admin') }}/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('assets_admin') }}/libs/feather-icons/feather.min.js"></script>
    <script src="{{ asset('assets_admin') }}/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="{{ asset('assets_admin') }}/js/plugins.js"></script>

    <!-- particles js -->
    <script src="{{ asset('assets_admin') }}/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="{{ asset('assets_admin') }}/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="{{ asset('assets_admin') }}/js/pages/password-addon.init.js"></script>
</html>
