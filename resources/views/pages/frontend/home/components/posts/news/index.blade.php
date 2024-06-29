<div class="blog-post-section sectionNews">
    <div class="container">
        <div class="section-title">
            <span class="sub-title">Blog Post</span>
            <h2 class="title" data-aos="fade-up">Berita Terakhir</h2>
        </div>
        <div class="blog-post-content row">
        </div>
        <div class="staco-pagination mt-2">
            <a href="{{ route('posts.allData', ['type' => 'news', 'pageId' => $page->id]) }}">
                Lihat Semua
            </a>
        </div>
    </div>
</div>


@push('js')
<script>
    $(document).ready(function() {
        getNewsData();
    });

    const getNewsData = () => {
        const $slider = $(".blog-post-content");
        $slider.html('');
        $slider.html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
        let html = "";
        const pageId = {!! json_encode($page->id) !!};
        requestAjax(`{{ route('posts.getData') }}`, {
            pageId,
            type: 'news',
            limit: 6,
            _token: "{{ csrf_token() }}"
        }, 'POST', 'JSON', function(response) {
            $slider.html('');
            if (response.length > 0) {
                response.map((value) => {
                    let link = `{{ route('posts.detailData', [':slug', ':type', ':pageId']) }}`;
                    link = link.replace(':slug', value.slug);
                    link = link.replace(':type', 'news');
                    link = link.replace(':pageId', pageId);
                    html += `
                         <div class="col-lg-4 col-md-6 pb-4" data-aos="fade-up">
                            <div class="blog-post-card blog-post-card1">
                                <div class="card-title">
                                    <h4>
                                        <a href="${link}"
                                            >${value.title}</a
                                        >
                                    </h4>
                                </div>
                                ${value.shortDescription}
                                <div class="card-footer">
                                    <a href="${link}" class="user">
                                        <span>${value.created_by}</span>
                                    </a>
                                    <span class="blog-date">${value.date}</span>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $(".sectionNews").show();
            } else {
                $(".sectionNews").hide();
                $(".sectionNews").removeClass();
            }
            $slider.html(html);
        });
    };
</script>
@endpush
