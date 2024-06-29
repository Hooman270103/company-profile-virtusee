@extends('layouts.frontend.app')


@section('content')
<section id="contact" class="contact">
  <div class="container">

      <div class="section-title">
          <h2 data-aos="fade-up">Kontak Kami</h2>
          {{-- <p data-aos="fade-up">Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid
              fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui
              impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> --}}
      </div>

      <div class="row justify-content-center">
          <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up">
              <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Alamat</h3>
                  <p>{{ $setting['address'] }}</p>
              </div>
          </div>

          <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="100">
              <div class="info-box">
                  <i class="bx bx-envelope"></i>
                  <h3>Email</h3>
                  <p>{{ $setting['email'] }}</p>
              </div>
          </div>
          <div class="col-xl-3 col-lg-4 mt-4" data-aos="fade-up" data-aos-delay="200">
              <div class="info-box">
                  <i class="bx bx-phone-call"></i>
                  <h3>No Telp</h3>
                  <p>{{ $setting['no_telp'] }}</p>
              </div>
          </div>
      </div>

      <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="300">
          <div class="col-xl-9 col-lg-12 mt-4">
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                  <div class="row">
                      <div class="col-md-6 form-group">
                          <input type="text" name="name" class="form-control" id="name"
                              placeholder="Nama Anda" required>
                      </div>
                      <div class="col-md-6 form-group mt-3 mt-md-0">
                          <input type="email" class="form-control" name="email" id="email"
                              placeholder="Email Anda" required>
                      </div>
                  </div>
                  <div class="form-group mt-3">
                      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"
                          required>
                  </div>
                  <div class="form-group mt-3">
                      <textarea class="form-control" name="message" rows="5" placeholder="Pesan Anda" required></textarea>
                  </div>
                  <div class="my-3">
                      <div class="loading">Loading</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div>
                  <div class="text-center"><button type="submit">Kirim Email</button></div>
              </form>
          </div>

      </div>

  </div>
</section>
@endsection