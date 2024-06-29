@extends('layouts.frontend.app')

@section('content')
<section class="portfolio-gallery-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center md-mb-0">
                    <h2 class="title">Foto Galeri</h2>
                </div>
            </div>
        </div>
        <!-- Photo Grid -->
        <div class="portfolio-gallery-content">
            <div class="portfolio-grid-container row" data-masonry='{"percentPosition": true }'>
                @if (count($photos) > 0)
                    @foreach ($photos as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="portfolio-gallery-card">
                                <div class="parallax-window" data-parallax="scroll" data-image-src="{{ $item->image }}">
                                    <a href="{{ $item->image }}" class="portfolio-img" data-lightbox="roadtrip"
                                        ><img src="{{ $item->image }}" alt="img"
                                    /></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row text-center justify-content-center">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/tbkntwzz.json" trigger="loop" delay="1500"
                                style="width:150px;height:150px">
                            </lord-icon>
                            <h3 class="fw-semibold" style="letter-spacing: 2px">Data Empty</h3>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </div>
</section>
@endsection
