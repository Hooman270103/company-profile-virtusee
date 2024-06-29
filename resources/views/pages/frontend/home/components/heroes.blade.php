<section class="hero-section2">
    <div class="container">
        <div class="row align-items-center divHeroes">
        </div>
    </div>
</section>

@push('js')
<script>
    $(document).ready(function() {
        getDataHeroes();
    });
    
    const getDataHeroes = () => {
            let menu = {!! json_encode($page) !!};
            $(".divHeroes").html('');
            $(".divHeroes").html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
            let html = "";
            requestAjax(`{{ route('heroes.getData') }}`, {
                _token: "{{ csrf_token() }}",
            }, 'POST', 'JSON', function(response) {
                $(".divHeroes").html('');
                html += `
                    <div class="col-lg-6">
                        <div class="hero-content hero-content2">
                            <div class="hero-content2-text mb-30">
                                <h1 class="banner-title" data-aos="fade-up">
                                    ${response.title}
                                </h1>
                                <p data-aos="fade-up" data-aos-duration="1500">
                                    ${response.description}    
                                </p>
                            </div>
                            <div class="hero-content-button mb-30">
                                <a href="{{ route('request-demo.index') }}" class="bg-blue-btn">
                                    <span class="btn-inner">
                                        <span class="btn-normal-text">Request Demo</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero2-img" data-aos="fade-left">
                            <img src="${response.image}" alt="hero-img" />
                        </div>
                    </div>
                    `;
                $(".divHeroes").html(html)
            });
        };
</script>
@endpush