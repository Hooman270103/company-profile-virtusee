@extends('layouts.frontend.app')

@section('content')

@if (isset($page) && $page->position == '1')
@include('pages.frontend.home.components.heroes')
@else
@include('pages.frontend.home.components.breadcrumb')
@endif
<div>
  

    @if (isset($page) && count($page->MenuSectionPost) > 0)
    @include('pages.frontend.home.components.posts.sectionPost.index')
    @endif

    @if (isset($page) && $page->position == '1')
    @include('pages.frontend.home.components.client')
    @endif

    @if (isset($page->MenuSection) && count($page->MenuSection) > 0)
    @include('pages.frontend.home.components.section-content')
    @endif

    @if (isset($page) && count($page->MenuNews) > 0)
    @include('pages.frontend.home.components.posts.news.index')
    @endif

    @if (isset($page) && count($page->MenuPost) > 0)
        @include('pages.frontend.home.components.posts.articles.index')
    @endif

    @if (isset($page) && count($page->MenuEvent) > 0)
    @include('pages.frontend.home.components.events.index')
    @endif

    @if (isset($page) && count($page->MenuGalleryPhoto) > 0)
    @include('pages.frontend.home.components.photos.index')
    @endif

    @if (isset($page) && count($page->MenuVideo) > 0)
    @include('pages.frontend.home.components.videos.index')
    @endif


    @if (isset($page) && count($page->MenuAnnouncements) > 0)
    @include('pages.frontend.home.components.posts.announcements.index')
    @endif

    @if (isset($page->MenuFaq) && count($page->MenuFaq) > 0)
    @include('pages.frontend.home.components.faq')
    @endif

    
    @if (isset($page->MenuCounter) && count($page->MenuCounter) > 0)
    @include('pages.frontend.home.components.counter-data')
    @endif

    @if (isset($page->MenuTestimoni) && count($page->MenuTestimoni) > 0)
    @include('pages.frontend.home.components.testimoni')
    @endif

    @include('pages.frontend.home.components.banner-demo')

</div>
@endsection