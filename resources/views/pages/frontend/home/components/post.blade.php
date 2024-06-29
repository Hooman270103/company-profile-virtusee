<section id="blog" class="blog">
  <div class="container" data-aos="fade-up">

    <div class="row">

      <div class="col-lg-4 col-sm-6 entries">
        <article class="entry">
          <div class="entry-img">
            <img src="{{ Vite::asset('resources/assets_frontend/') }}/img/blog/blog-1.jpg" alt="" class="img-fluid">
          </div>

          <h2 class="entry-title">
            <a href="blog-single.html">Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia</a>
          </h2>

          <div class="entry-meta">
            <ul>
              <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">John Doe</a></li>
              <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
              <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-single.html">12 Comments</a></li>
            </ul>
          </div>

          <div class="entry-content">
            <p>
              Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.
              Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.
            </p>
            <div class="read-more">
              <a href="blog-single.html">Read More</a>
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
</section>

@push('js')
    <script>
        $(document).ready(function() {
            getPost();
        });
        function getPost() {
            let menu = {!! json_encode($page) !!}
            console.log(menu);
            let html = '';
            $.ajax({
                url: "{{ route('posts.get-datas') }}",
                data : {'type' : 'berita', 'menu' : menu},
                success: function(data) {
                    $("#swiper-wrapper").html('');
                    if (data.length > 0) {
                        data.map((value) => {
                            html += `
                                <div class="swiper-slide p-5">
                                    <img class="img-fluid" src="${value.image}" alt="">
                                </div>
                            `;
                        });
                    }
                    $("#swiper-wrapper").html(html);
                }
            });
        }
    </script>
@endpush