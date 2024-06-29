<style>
    .img-section-post{
        border-radius: 20px;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }
</style>
<section class="hero-section2 sectionPost">
  
</section>



@push('js')
<script>
    $(document).ready(function() {
        getSectionPost();
    });

    const getSectionPost = () => {
        const $slider = $(".sectionPost");
        $slider.html('');
        $slider.html(`<div class="d-flex justify-content-center">${setLoading()}</div>`);
        let html = "";
        const pageId = {!! json_encode($page->id) !!};
        requestAjax(`{{ route('posts.getData') }}`, {
            pageId,
            type: 'sectionPost',
            limit: 6,
            _token: "{{ csrf_token() }}"
        }, 'POST', 'JSON', function(response) {
            $slider.html('');
            if (response.length > 0) {
                response.map((value) => {
                    html += `
                       
                          <div class="container">
                              <div class="row align-items-center">
                                  <div class="col-lg-7 col-sm-12">
                                      <div class="hero-content hero-content2">
                                          <div class="hero-content2-text">
                                              <div class="new-hoogle">
                                                  <p class="mb-0">Section Post</p>
                                              </div>
                                              <h1 class="banner-title" data-aos="fade-up">
                                                  ${value.title}
                                              </h1>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-lg-5 col-sm-12">
                                      <div class="hero2-img img-section-post" data-aos="fade-left">
                                          <img src="${value.image}" alt="hero-img" />
                                      </div>
                                  </div>
                                  <div class="col-lg-12 col-sm-12 mt-3" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
                                    ${value.description}
                                  </div>
                                  
                              </div>
                          </div>
                    `;
                });
                $(".sectionPost").show();
            } else {
                $(".hero-section2").hide();
                $(".hero-section2").removeClass();
            }
            $slider.html(html);
        });
    };
</script>
@endpush