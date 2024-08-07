@extends('layouts.frontend.app')

@section('content')
    <style>
        .letest-blog-card {
            box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;
        }
    </style>
    <section class="latest-blog-section">
        <div class="container">
            <div class="col-lg-12 col-sm-12">
                <div class="section-title text-center md-mb-0">
                    <h2 class="title">Semua {{ $type }}</h2>
                </div>
            </div>
            <div class="col-lg-12 col-sm-12">
                <div class="latest-blog-content">
                    <div class="row sectionDataEvents">
                        @if (count($posts) > 0)
                            <div class="row">
                                @foreach ($posts as $item)
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="letest-blog-card" data-aos="fade-up"
                                        data-aos-duration="1500">
                                            <a href="blog-details.html" class="letest-blog-img">
                                                <img src="{{ $item->image }}" alt="img" />
                                            </a>
                                            <div class="letest-blog-info">
                                                <div class="letest-blog-info-inner">
                                                    <h4>
                                                        <a href="{{  route('posts.detailData', ['slug' => $item->slug, 'type' => $type, 'pageId' => $pageId]) }}">{{ $item->title }}</a>
                                                    </h4>
                                                    <a href="{{  route('posts.detailData', ['slug' => $item->slug, 'type' => $type, 'pageId' => $pageId]) }}" class="text-link">
                                                        <span>Baca Selengkapnya</span>
                                                        <span class="iconify" data-icon="akar-icons:arrow-right"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                {{ $posts->links('vendor.pagination.bootstrap-5') }}
                            </div>
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
        </div>
    </section>
@endsection
