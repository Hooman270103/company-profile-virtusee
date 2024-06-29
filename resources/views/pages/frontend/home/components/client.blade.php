<section class="brands-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="brands-section-title">
                    {{-- <h2>Client yang telah menggunakan Virtusee</h2> --}}
                </div>
                <div class="brands-slider">
                    <div class="brands-slider-container">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('js')
<script>
    $(document).ready(function() {
        getLogoSlidersData();
    });
    
    const getLogoSlidersData = () => {
            $(".brands-slider-container").html('');
            $(".brands-slider-container").html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
            let html = "";
            requestAjax(`{{ route('logo-sliders.getData') }}`, {}, 'GET', 'JSON', function(response) {
                $(".brands-slider-container").html('');
                if (response.length > 0) {
                  response.map((value) => {
                  html += `
                        <div class="slider-item" data-aos="fade-up">
                            <img src="${value.image}" alt="slider-img" />
                        </div>
                      `;
                })

                } else {
                    $(".brands-section").html('');
                    $(".brands-section").removeClass();
                }
                $(".brands-slider-container").html(html)
            });
        };
</script>
@endpush