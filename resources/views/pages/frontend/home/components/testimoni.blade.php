<section class="corporate-testiminials-section">
    <div class="overlay">
        <div class="container">
            <div class="corporate-testiminials-slider row">
                <div class="testimoniCard"></div>
            </div>
        </div>
    </div>
</section>


@push('js')
    <script>
        $(document).ready(function() {
            getTestimoniData();
        });

        const getTestimoniData = () => {
            let menu = {!! json_encode($page) !!};
            $(".testimoniCard").html('');
            $(".testimoniCard").html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
            let html = "";
            requestAjax(`{{ route('testimoni.getData') }}`, {
                _token: "{{ csrf_token() }}",
                data: { menu: menu },
            }, 'POST', 'JSON', function(response) {
                $(".testimoniCard").html('');
                if (response.length > 0) {
                    response.map((value) => {
                        html += `
                            <div class="col-md-12" data-aos="fade-up" >
                                <div class="corporate-testiminials-content" data-aos="fade-up" data-aos-duration="1500">
                                    <div class="clint-img">
                                        <div class="clint-img-inner">
                                            <img src="${value.image}" alt="img" />
                                        </div>
                                    </div>
                                    <p>${value.testimoni}</p>
                                    <h5>${value.name}<span>${value.title}</span></h5>
                                </div>
                            </div>
                        `;
                    });

                    $(".testimoniCard").html(html);

                    // Initialize Slick Slider after adding the HTML
                    $('.testimoniCard').slick({
                        dots: true,
                        infinite: true,
                        speed: 300,
                        slidesToShow: 1,
                        adaptiveHeight: true,
                        autoplay: true,
                        autoplaySpeed: 2000,
                        prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
                        nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>'
                    });

                } else {
                    html += `
                        <div class="col-xl-12">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/tbkntwzz.json" trigger="loop" delay="1500"
                                    style="width:150px;height:150px">
                                </lord-icon>
                                <h3 class="fw-semibold" style="letter-spacing: 2px">Data Empty</h3>
                            </div>    
                        </div>
                    `;
                    $(".testimoniCard").html(html);
                }
            });
        };
    </script>
@endpush
