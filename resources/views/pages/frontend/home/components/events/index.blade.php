<style>
    .letest-blog-card {
        box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;
    }
</style>
<section class="latest-blog-section">
    <div class="container">
        <div class="col-lg-12 col-sm-12">
            <div class="section-title text-center md-mb-0">
                {{-- <span class="sub-title">EVENT</span> --}}
                <h2 class="title" data-aos="fade-up">Event</h2>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12">
            <div class="latest-blog-content">
                <div class="row sectionDataEvents">
                    
                </div>
            </div>
        </div>
        <div class="staco-pagination mt-2">
            <a href="{{ route('events.allData') }}">
                Lihat Semua
            </a>
        </div>
    </div>
</section>

@push('js')
    <script>
        $(document).ready(function() {
            getEventsData();
        });

        const getEventsData = () => {
            $(".sectionDataEvents").html('');
            $(".sectionDataEvents").html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
            let html = "";
            requestAjax(`{{ route('events.getData') }}`, {
                limit: 6,
                _token: "{{ csrf_token() }}"
            }, 'POST', 'JSON', function(response) {
                console.log(response);
                $(".sectionDataEvents").html('');
                if (response.length > 0) {
                    response.map((value) => {
                        let link = `{{ route('events.detailData', ':slug') }}`;
                        link = link.replace(':slug', value.slug);
                        html += `

                        <div class="col-lg-4 col-sm-6">
                            <div class="letest-blog-card" data-aos="fade-up"
                            data-aos-duration="1500">
                                <a href="blog-details.html" class="letest-blog-img">
                                    <img src="${value.image}" alt="img" />
                                </a>
                                <div class="letest-blog-info">
                                    <div class="letest-blog-info-inner">
                                        <h5><span>${value.location}</span> ${value.schedule}</h5>
                                        <h4>
                                            <a href="${link}">${value.title}</a>
                                        </h4>
                                        <ul>
                                            <li>
                                                <span class="iconify" data-icon="akar-icons:person"></span>
                                                ${value.pic ? value.pic : '-'}
                                            </li>
                                            <li>
                                                <span class="iconify" data-icon="akar-icons:phone"></span>
                                                ${value.phone ? value.phone : '-'}
                                            </li>
                                        </ul>
                                        <a href="${link}" class="text-link">
                                            <span>Baca Selengkapnya</span>
                                            <span class="iconify" data-icon="akar-icons:arrow-right"></span>
                                        </a>
                                    </div>
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
                $(".sectionDataEvents").html(html)
            });
        }
    </script>
@endpush
