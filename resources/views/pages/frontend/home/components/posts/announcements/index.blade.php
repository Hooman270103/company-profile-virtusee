<section class="why-choose-section sectionAnnouncements">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center z-index-3">
                    <span class="sub-title">Blog Post</span>
                    <h2 class="title" data-aos="fade-up">Pemberitahuan</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="why-choose-parent">
        <div class="overlay-left"></div>
        <div class="overlay-right"></div>
        <div class="why-choose-container container">
            <div class="row why-chose-slider sliderContentAnnouncements">
                <!-- Announcement content will be dynamically inserted here -->
                <div class="text-slick"></div>
            </div>
        </div>
    </div>
</section>


@push('js')
    <script>
        $(document).ready(function() {
            getAnnouncementsData();
        });

        const getAnnouncementsData = () => {
            const $slider = $(".text-slick");
            $slider.html('');
            $slider.html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
            let html = "";
            let htmlTitle = "";
            const pageId = {!! json_encode($page->id) !!};
            requestAjax(`{{ route('posts.getData') }}`, {
                pageId,
                type: 'announcement',
                limit: 6,
                _token: "{{ csrf_token() }}"
            }, 'POST', 'JSON', function(response) {
                $slider.html('');
                if (response.length > 0) {
                    response.map((value, key) => {

                        html += `
                               <div class="col-md-12" data-aos="fade-down">
                                    <div class="section">
                                        <div class="tab-body">
                                            <div class="tab-body-img">
                                                <img src="${value.image}" alt="img" />
                                            </div>
                                            <div class="tab-body-text">
                                                <h2>${value.title}</h2>
                                                ${value.description}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        `;

                    });
                    $(".sectionAnnouncements").show();
                } else {
                    $(".sectionAnnouncements").hide();
                    $(".sectionAnnouncements").removeClass();
                }
                $slider.html(html);


                $('.text-slick').slick({
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
            });
        };

        const initializeSlider = () => {
            const $buttons = $('.tab-btn');
            const $slides = $('.slide');

            $buttons.on('click', function() {
                const slideIndex = $(this).data('slide');
                $buttons.removeClass('active');
                $(this).addClass('active');
                $slides.hide();
                $slides.filter(`[data-slide="${slideIndex}"]`).show();
            });

            // Show the first slide by default
            $buttons.first().addClass('active');
            $slides.hide();
            $slides.first().show();
        };
    </script>
@endpush
