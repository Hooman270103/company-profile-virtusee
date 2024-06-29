<section class="best-services-section sectionArticles">
    <div class="overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="best-services-left">
                        <div class="section-title corporate md-mb-0">
                            <span class="sub-title">Best Post</span>
                            <h2 class="title mb-0" data-aos="fade-up">Artikel</h2>
                            <div class="staco-pagination mt-2">
                                <a href="{{ route('posts.allData', ['type' => 'articles', 'pageId' => $page->id]) }}">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row corporate-servicels-slider slick-initialized slick-slider">
                        <div class="sliderArticles"></div>
                        <div class="slick-list draggable">
                            <div class="slick-track">
                                <div class="div_slick_article row">

                                </div>
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
            getArticlesData();
        });

        const getArticlesData = () => {
        const $slider = $(".div_slick_article");
        $slider.html('');
        $slider.html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
        let html = "";
        const pageId = {!! json_encode($page->id) !!};
        requestAjax(`{{ route('posts.getData') }}`, {
            pageId,
            type: 'articles',
            limit: 6,
            _token: "{{ csrf_token() }}"
        }, 'POST', 'JSON', function(response) {
            $slider.html('');
            if (response.length > 0) {
                response.map((value) => {
                    let link = `{{ route('posts.detailData', [':slug', ':type', ':pageId']) }}`;
                    link = link.replace(':slug', value.slug);
                    link = link.replace(':type', 'articles');
                    link = link.replace(':pageId', pageId);
                    html += `
                        <div class="col-lg-4 col-sm-6">
                            <div class="best-services-card" data-aos="fade-down">
                                <div class="best-services-img">
                                    <img src="${value.image}" alt="img"/> 
                                </div>
                                <div class="best-services-text" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                                    <a href="${link}"><h5 class="wt-700">${value.title}</h5></a>
                                    ${value.shortDescription}
                                </div>
                            </div>
                        </div>
                    `;

                });
                $(".sectionArticles").show();
            } else {
                $(".sectionArticles").hide();
                $(".sectionArticles").removeClass();
            }
            $slider.html(html);

            $('.div_slick_article').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3
            })
           
        });
    };
    </script>
@endpush
