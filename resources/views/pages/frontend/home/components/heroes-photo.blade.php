<section class="hero-image-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="testimonial-card">
                    <div class="testimonial-card-left">
                        <div class="testimonial-slider-nav">
                            <!-- Gambar akan dimuat di sini melalui Ajax -->
                            <div class="slider-item" >

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@push('js')
<script>
    $(document).ready(function() {
        getHeroImageData();
    });

    const getHeroImageData = () => {
        $(".slider-item").html('');
        $(".slider-item").html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
        let html = "";
        requestAjax(`{{ route('hero.getData') }}`, {}, 'GET', 'JSON', function(response) {
            $(".slider-item").html('');
            if (response.length > 0) {
                response.map((value) => {
                    html += `
                        <div class="slider-item">
                            <img src="/uploads/${value.image}" class="img-fluid" alt="slider-img" />
                            </div>
                    `;
                });

                $(".slider-item").html(html);

                // Inisialisasi Slick Slider setelah menambahkan HTML
                $('.slider-item').slick({
                    dots: true,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    adaptiveHeight: true,
                    autoplay: true,
                    autoplaySpeed: 2000
                });
            } else {
                $(".hero-image-section").html('');
                $(".hero-image-section").removeClass();
            }
        });
    };
</script>
@endpush

