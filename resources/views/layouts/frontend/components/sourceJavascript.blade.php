

<!-- jQuery v3.6.1 js -->
<script src="{{ asset('assets_frontend') }}/js/jquery-3.6.1.min.js"></script>
<!-- popper v2.11.6 js -->
<script src="{{ asset('assets_frontend') }}/js/popper.min.js"></script>
<!-- Bootstrap  v5.2.1 js -->
<script src="{{ asset('assets_frontend') }}/js/bootstrap.min.js"></script>
<!-- masonry js -->
<script src="{{ asset('assets_frontend') }}/js/masonry.pkgd.min.js"></script>
<!-- Iconify v3.0.0 js -->
<script src="{{ asset('assets_frontend') }}/js/iconify.min.js"></script>
<!-- modernizr js -->
<script src="{{ asset('assets_frontend') }}/js/modernizr.js"></script>
<!-- slick slider js -->
<script src="{{ asset('assets_frontend') }}/js/slick.min.js"></script>
<!-- swiper slider js --->
<script src="{{ asset('assets_frontend') }}/js/swiper.min.js"></script>
<!-- pie progress js -->
<script src="{{ asset('assets_frontend') }}/js/jquery-asPieProgress.js"></script>
<!-- VenoBox 2.0.4 js -->
<script src="{{ asset('assets_frontend') }}/js/venobox.min.js"></script>
<!-- Splitting js -->
<script src="{{ asset('assets_frontend') }}/js/splitting.js"></script>
<script src="{{ asset('assets_frontend') }}/js/splitting-out.js"></script>
<!-- jquery.rollNumber js -->
<script src="{{ asset('assets_frontend') }}/js/jquery.rollNumber.js"></script>
<!-- parallax js -->
<script src="{{ asset('assets_frontend') }}/js/parallax.min.js"></script>
<!-- ScrollTrigger 3.11.2 js -->
<script src="{{ asset('assets_frontend') }}/js/ScrollTrigger.min.js"></script>
<!-- Headline.js -->
<script src="{{ asset('assets_frontend') }}/js/headline.js"></script>
<!-- Image Light box -->
<script src="{{ asset('assets_frontend') }}/js/lightbox.js"></script>
<!-- sticky sidebar js -->
<script src="{{ asset('assets_frontend') }}/js/sticky-sidebar.js"></script>
<!-- Image Loaded js -->
<script src="{{ asset('assets_frontend') }}/js/imagesloaded.pkgd.min.js"></script>
<!-- isotop -->
<script src="{{ asset('assets_frontend') }}/js/isotope.pkgd.min.js"></script>
<!-- darkMood tsx -->
<script src="{{ asset('assets_frontend') }}/js/dark-mood-js.txt"></script>
<!-- custom js -->
<script src="{{ asset('assets_frontend') }}/js/main.js"></script>


<script>
  $(document).ready(function() {
      $('.select2').select2();
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.lordicon.com/lordicon.js"></script>
@include('components.include.extendJavascript')

@stack('js')
