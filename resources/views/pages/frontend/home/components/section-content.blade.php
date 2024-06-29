<div class="sectionData">
</div>

@push('js')
<script>
    $(document).ready(function() {
      getSectionData();
    });
    
    const getSectionData = () => {
            let menu = {!! json_encode($page) !!};
            $(".sectionData").html('');
            $(".sectionData").html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
            let html = "";
            requestAjax(`{{ route('section.getData') }}`, {
                limit: 6,
                _token: "{{ csrf_token() }}",
                data:{menu:menu},
            }, 'POST', 'JSON', function(response) {
                $(".sectionData").html('');
                if (response.length > 0) {
                  response.map((value) => {
                  if (value.position == 1) {
                      html += `
                          <section class="marketing-section">
                              <div class="container">
                                  <div class="row align-items-center justify-content-between">
                                      <div class="col-xl-5 col-lg-6">
                                          <div class="marketing-img" data-aos="fade-right">
                                              <img src="${value.image}" alt="marketing-img">
                                          </div>
                                      </div>
                                      <div class="col-xl-6 col-lg-6">
                                          <div class="marketing-content">
                                              <div class="marketing-content-title">
                                                  <div class="section-title">
                                                     <span class="sub-title">SECTION</span>
                                                      <h2 class="title" data-aos="fade-up">
                                                          ${value.title}
                                                      </h2>
                                                  </div>
                                              </div>
                                              <div class="marketing-content-body" data-aos="fade-up" data-aos-duration="1500">
                                                 <div class="mb-30">
                                                      ${value.description}
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </section>
                      `;
                  } else {
                      html += `
                          <section class="marketing-section md-pt-60">
                              <div class="container">
                                  <div class="row align-items-center justify-content-between">
                                      <div class="col-xl-6 col-lg-6 order-lg-1 order-2">
                                          <div class="marketing-content">
                                            <span class="sub-title">SECTION</span>
                                              <div class="section-title" data-aos="fade-up">
                                                  <h2 class="title">${value.title}</h2>
                                              </div>
                                              <div class="marketing-content-body" data-aos="fade-up" data-aos-duration="1500">
                                                  <div class="mb-30">
                                                      ${value.description}
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-xl-5 col-lg-6 order-lg-2 order-1">
                                          <div class="marketing-img v2" data-aos="fade-left">
                                              <img src="${value.image}" alt="marketing-img" />
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </section>
                      `;
                  }
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
                $(".sectionData").html(html)
            });
        };
</script>
@endpush