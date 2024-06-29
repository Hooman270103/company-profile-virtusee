<section class="feature-section md-pt-40 md-pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center md-mb-0">
                    <span class="sub-title">GALERI</span>
                    <h2 class="title">Foto Galeri</h2>
                </div>
            </div>
        </div>
        <div class="row staco-hover-effect">
        </div>
    </div>
</section>

@push('js')
    <script>
        $(document).ready(function() {
            getPhotosData();
        });

        const getPhotosData = () => {
            let menu = {!! json_encode($page->id) !!};
            $(".staco-hover-effect").html('');
            $(".staco-hover-effect").html(`<div class="d-flex justify-content-center mx-auto">${setLoading()}</div>`);
            let html = "";
            requestAjax(`{{ route('photos.getData') }}`, {
                _token: "{{ csrf_token() }}",
                data:{menu:menu},
            }, 'POST', 'JSON', function(response) {
                $(".staco-hover-effect").html('');
                if (response.length > 0) {
                    response.map((value) => {
                        let link = `{{ route('photos.detailData', ':slug') }}`;
                        link = link.replace(':slug', value.slug);
                        html +=
                            `
                                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                                    <div class="feature-card">
                                        <div class="feature-card-shape">
                                            <img src="{{ asset('assets_frontend') }}/images/main-demo/Frame.svg" alt="card-shape" />
                                        </div>
                                        <div class="feature-card-icon">
                                            <img src="{{ asset('assets_frontend') }}/images/main-demo/images-frame.svg" alt="feature-img" />
                                        </div>
                                        <a href="${link}">
                                            <div class="feature-card-text">
                                                <h5>${value.name}</h5>
                                                <p>
                                                    Jumlah Foto : ${value.gallery.length}
                                                </p>
                                            </div>
                                        </a>
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
                $(".staco-hover-effect").html(html)
            });
        }
    </script>
@endpush
