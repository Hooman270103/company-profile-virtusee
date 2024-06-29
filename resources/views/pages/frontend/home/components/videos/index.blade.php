<section class="feature-section md-pt-40 md-pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center md-mb-0">
                    <span class="sub-title">VIDEO</span>
                    <h2 class="title">Galeri Video</h2>
                </div>
            </div>
        </div>
        <div class="row sectionGalleryVideos">
        </div>
    </div>
</section>

@push('js')
<script>
    $(document).ready(function() {
        getVideosData();
    });

    const getVideosData = () => { 
        let menu = {!! json_encode($page->id) !!};
        $(".sectionGalleryVideos").html('');
        $(".sectionGalleryVideos").html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
        let html = "";
        requestAjax(`{{ route('videos.get-datas') }}`, {
            _token: "{{ csrf_token() }}",
            data: { menu: menu },
        }, 'POST', 'JSON', function(response) {
            $(".sectionGalleryVideos").html('');
            if (response.length > 0) {
                response.map((value) => {
                    html += `
                        <div class="col-lg-6 col-md-6" data-aos="fade-up">
                            <div class="feature-card">
                                <div class="feature-card-icon">
                                    <iframe width="560" height="315" src="${value.link}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                                <div class="feature-card-text">
                                    <h5>${value.title}</h5>
                                    <p>${value.created}</p>
                                </div>
                            </div>
                        </div>
                    `;
                })
            } else {
                html += `<div class="text-center w-100">
                            <lord-icon src="https://cdn.lordicon.com/tbkntwzz.json" trigger="loop" delay="1500"
                                style="width:150px;height:150px">
                            </lord-icon>
                            <h3 class="fw-semibold" style="letter-spacing: 2px">Data Empty</h3>
                        </div>`;
            }
            $(".sectionGalleryVideos").html(html)
        });
    }
</script>
@endpush
