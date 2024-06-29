@extends('layouts.frontend.app')

@section('content')
<section class="breadcrumb-section blog-details-breadcrumb-section">
    <div class="bg-shape">
        <div class="shape-img img-1"><img src="{{ asset('assets_frontend') }}/images/shape/breadcrumb-shape1.svg"
                alt="shape" /></div>
        <div class="shape-img img-2"><img src="{{ asset('assets_frontend') }}/images/shape/breadcrumb-shape2.svg"
                alt="shape" /></div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="breadcrumb-content">
                    <div class="breadcrumb-sec">
                        <h1 class="breadcrumb-title">Detail Post {{ $type }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="blog-details-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-details-content">
                    <div class="blog-details-img">
                        @php
                        $file = getStorage($post->image);
                        @endphp
                        <img src="data:image/png;base64,{{ $file }}" alt="Event Image" width="100%">
                    </div>
                    <div class="blog-details-inner">
                        <div class="blog-details-info-list">
                        </div>
                        <p class="blog-details-headline">
                            {{ $post->title }}
                        </p>
                        <p class="blog-text">
                            {!! $post->description !!}
                        </p>
                    </div>
                    <div class="post-tags-section">
                        <h4 class="letest-blog-catd-title">Tags</h4>
                        <ul>
                            @foreach ($post->tags as $tags)
                            <li> <a href="#">{{ $tags }}</a> </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="letest-blog-card">
                    <div class="recent-post-section">
                        <h4 class="letest-blog-catd-title">{{ $type }} Lainnya</h4>
                        <ul>
                            @if (count($otherPosts) > 0)
                            <div class="row">
                                @foreach ($otherPosts as $item)
                                <li>
                                    <a href="{{ route('posts.detailData', ['slug' => $item->slug, 'type' => $type, 'pageId' => $pageId]) }}" class="recent-post-img">
                                        <img src="{{ $item->image }}" alt="img" />
                                    </a>
                                    <div class="recent-post-text">
                                        <h5><a
                                                href="{{ route('posts.detailData', ['slug' => $item->slug, 'type' => $type, 'pageId' => $pageId]) }}">{{
                                                $item->title }}</a></h5>
                                    </div>
                                </li>
                                @endforeach
                            </div>
                            @else
                            <div class="row text-center justify-content-center">
                                <div class="alert alert-danger">
                                    <h4>{{ $type }} lainnya lagi kosong!</h4>
                                </div>
                            </div>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection