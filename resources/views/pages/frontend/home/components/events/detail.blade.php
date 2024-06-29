@extends('layouts.frontend.app')

@section('content')
    <section class="breadcrumb-section blog-details-breadcrumb-section">
        <div class="bg-shape">
            <div class="shape-img img-1"><img src="{{ asset('assets_frontend') }}/images/shape/breadcrumb-shape1.svg" alt="shape" /></div>
            <div class="shape-img img-2"><img src="{{ asset('assets_frontend') }}/images/shape/breadcrumb-shape2.svg" alt="shape" /></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="breadcrumb-content">
                        <div class="breadcrumb-sec">
                            <h1 class="breadcrumb-title">Detail Event</h1>
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
                                $file = getStorage($event->image);
                            @endphp
                            <img src="data:image/png;base64,{{ $file }}" alt="Event Image" width="100%">
                        </div>
                        <div class="blog-details-inner">
                            <div class="blog-details-info-list">
                                <ul>
                                    <li>
                                        <span><img src="{{ asset('assets_frontend') }}/images/icons/icon_profile.svg" alt="icon" /></span>By
                                        - <a href="#">{{ $event->pic ? $event->pic : '-' }}</a>
                                    </li>
                                    <li>
                                        <span><img src="{{ asset('assets_frontend') }}/images/icons/location.svg" alt="icon" /></span
                                        ><a href="#">{{ $event->location }}</a>
                                    </li>
                                    <li>
                                        <span><img src="{{ asset('assets_frontend') }}/images/icons/icon_calendar.svg" alt="icon" /></span
                                        >{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->schedule)->format('l, j F Y H:i') }}
                                    </li>
                                    <li>
                                        <span><img src="{{ asset('assets_frontend') }}/images/icons/phone.svg" alt="icon" /></span
                                        >{{ $event->phone ? $event->phone : '-' }}
                                    </li>
                                </ul>
                            </div>
                            <p class="blog-details-headline">
                                {{ $event->title }}
                            </p>
                            <p class="blog-text">
                                {!! $event->description !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="letest-blog-card">
                        <div class="recent-post-section">
                            <h4 class="letest-blog-catd-title">Event Lainnya</h4>
                            <ul>
                                @if (count($otherEvents) > 0)
                                    <div class="row">
                                        @foreach ($otherEvents as $item)
                                            <li>
                                                <a href="{{ route('events.detailData', $item->slug) }}" class="recent-post-img">
                                                    <img src="{{ $item->image }}" alt="img" />
                                                </a>
                                                <div class="recent-post-text">
                                                    <span class="blog-date">{{ $item->schedule }}</span>
                                                    <h5><a href="{{ route('events.detailData', $item->slug) }}">{{ $item->title }}</a></h5>
                                                </div>
                                            </li>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="row text-center justify-content-center">
                                        <div class="alert alert-danger">
                                            <h4>Artikel lainnya lagi kosong!</h4>
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
