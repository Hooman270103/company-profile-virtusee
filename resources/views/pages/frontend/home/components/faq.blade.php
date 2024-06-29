<section class="faq-seciton">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="section-title md-mb-50">
                    <span class="sub-title">FAQ</span>
                    <h2 class="title" data-aos="fade-up">
                        Pertannyan Yang Sering Ditanyakan?
                    </h2>
                </div>
                <div class="leave-message leave-message1" data-aos="fade-up" data-aos-duration="1500">
                    <div class="mb-20">
                        <p>{{ $setting['description'] }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="accordion theme-accordion" id="accordionExample">
                </div>
            </div>
            <div class="leave-message leave-message2">
                <a href="#" class="msg-btn rotate-icon-btn">
                    <img class="rotate-icon" src="{{ asset('assets_frontend') }}/images/icons/shape-msg.svg"
                        alt="mail-us" />
                    <span class="icon">
                        <img src="{{ asset('assets_frontend') }}/images/icons/sms-tracking.svg" alt="msg" />
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

@push('js')
<script>
    $(document).ready(function() {
        getFaqData();
    });
    
    const getFaqData = () => {
            let menu = {!! json_encode($page) !!};
            $(".accordion").html('');
            $(".accordion").html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
            let html = "";
            requestAjax(`{{ route('faq.getData') }}`, {
                limit: 6,
                _token: "{{ csrf_token() }}",
                data:{menu:menu},
            }, 'POST', 'JSON', function(response) {
                $(".accordion").html('');
                if (response.length > 0) {
                  response.map((value) => {
                  html += `
                        <div class="accordion-item" data-aos="fade-up">
                            <h2 class="accordion-header" id="${value.id}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo_${value.id}" aria-expanded="false" aria-controls="collapseTwo_${value.id}">
                                    ${value.questions}
                                </button>
                            </h2>
                            <div id="collapseTwo_${value.id}" class="accordion-collapse collapse" aria-labelledby="${value.id}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>
                                        ${value.answers}
                                    </p>
                                </div>
                            </div>
                        </div>
                      `;
                })

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
                }
                $(".accordion").html(html)
            });
        };
</script>
@endpush