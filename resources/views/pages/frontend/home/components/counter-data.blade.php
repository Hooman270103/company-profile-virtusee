<section class="counterSection">
    <div
    class="index2-statistics-section parallax-window"
    data-parallax="scroll"
    data-image-src="{{ asset('assets_frontend') }}/images/bg/vector-map.svg"
    >
    <div class="container">
        <div class="index2-statistics-content">
            <div class="row counterData">
                
            </div>
        </div>
    </div>
    </div>
</section>

@push('js')
<script>
      $(document).ready(function() {
        getCounterData();
    });
    
    const getCounterData = () => {
            let menu = {!! json_encode($page->id) !!};
            $(".counterData").html('');
            $(".counterData").html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
            let html = "";
            requestAjax(`{{ route('counter.getData') }}`, {
                limit: 6,
                _token: "{{ csrf_token() }}",
                data:{menu:menu},
            }, 'POST', 'JSON', function(response) {
                $(".counterData").html('');
                if (response.length > 0) {
                  response.map((value) => {
                  value.data_counter.map((datas) => {
                    html += `
                          <div class="col-md-4 md-mb-30">
                              <div class="statistics-text">
                                  <h2 class="fw-bold">${Number(datas.number)}</h2>
                                  <p>${datas.title}</p>
                              </div>
                          </div>
                        `;
                    
                  })
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
                $(".counterData").html(html)
            });
        };
</script>   
@endpush