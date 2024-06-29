@extends('layouts.app')

@push('title')
    Dashboard
@endpush


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <h4>Selamat Datang, {{ Auth::user()->name }}</h4>
            </div>
        </div>
    </div>
@endsection
