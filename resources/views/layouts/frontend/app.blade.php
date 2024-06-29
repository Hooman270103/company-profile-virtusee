<!DOCTYPE html>
<html lang="en">

@include('layouts.frontend.components.head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<style>
    :root {
        --primary-color-100: {{ trim($setting['color_primary']->primary_100, '"') }};
        --primary-color-200: {{ trim($setting['color_primary']->primary_200, '"') }};
        --primary-color-300: {{ trim($setting['color_primary']->primary_300, '"') }};
        --primary-color-400: {{ trim($setting['color_primary']->primary_400, '"') }};
        --primary-color-500: {{ trim($setting['color_primary']->primary_500, '"') }};
        --primary-color-600: {{ trim($setting['color_primary']->primary_600, '"') }};
        --primary-color-700: {{ trim($setting['color_primary']->primary_700, '"') }};
        --primary-color-800: {{ trim($setting['color_primary']->primary_800, '"') }};
        --primary-color-900: {{ trim($setting['color_primary']->primary_900, '"') }};
        --secondary-color-100: {{ trim($setting['color_secondary']->secondary_100, '"') }};
        --secondary-color-200: {{ trim($setting['color_secondary']->secondary_200, '"') }};
        --secondary-color-300: {{ trim($setting['color_secondary']->secondary_300, '"') }};
        --secondary-color-400: {{ trim($setting['color_secondary']->secondary_400, '"') }};
        --secondary-color-500: {{ trim($setting['color_secondary']->secondary_500, '"') }};
        --secondary-color-600: {{ trim($setting['color_secondary']->secondary_600, '"') }};
        --secondary-color-700: {{ trim($setting['color_secondary']->secondary_700, '"') }};
        --secondary-color-800: {{ trim($setting['color_secondary']->secondary_800, '"') }};
        --secondary-color-900: {{ trim($setting['color_secondary']->secondary_900, '"') }};
    }
</style>

<body>
    <div class="staco-overly-bg"></div>
     {{-- navbar --}}
     @include('layouts.frontend.components.navbar')

    <!-- ======= Hero Section ======= -->
   
    <div>
        @yield('content')
    </div>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('layouts.frontend.components.footer')

    <!-- scroll top section start -->
    <div class="staco-scroll-top">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
        <div class="staco-scroll-top-icon">
            <span class="iconify" data-icon="mdi:arrow-up"></span>
        </div>
    </div>
    <!-- scroll top section end -->

    <!-- Vendor JS Files -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session()->has('success'))
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: '{{ session()->get('success') }}',
                showConfirmButton: false,
                timer: 3000
            })
        @endif

        @if (session()->has('danger'))
            Swal.fire({
                icon: "error",
                title: "Danger!",
                text: '{{ session()->get('danger') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    @include('layouts.frontend.components.sourceJavascript')


</body>

</html>
