@extends('layouts.app')

@push('title')
    Form Gallery Category
@endpush


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="border p-4">
                @if (Route::is('admin.gallery-category.create'))
                    <form action="{{ route('admin.gallery-category.store') }}" method="POST">
                    @else
                        <form action="{{ route('admin.gallery-category.update', $galleryCategory->id) }}" method="POST">
                            @method('PUT')
                @endif
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="mb-2">
                            <label for="name" class="form-label">Name <i class="text-danger">*</i> </label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $galleryCategory->name) }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="mb-2">
                            <label for="menus" class="form-label">Menus <i class="text-danger">*</i></label>
                            <select name="menus[]" id="menus" class="form-select select2" multiple="multiple">
                                <option value="" disabled>--Choose Menu--</option>
                                @php
                                    $array = [];
                                    if (isset($galleryCategory)) {
                                        foreach ($galleryCategory->menuGalleryCategory as $key => $value) {
                                            $array[] = $value->menu_id;
                                        }
                                    }
                                @endphp
                                @foreach ($allMenu as $item)
                                    <option value="{{ $item->id }}" {{ in_array($item->id, $array) ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('menus')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-2">
                            <label for="posting" class="form-label">Posting<i class="text-danger">*</i> </label>
                            <select name="posting" id="posting" class="from-control form-select select2">
                                <option value="">--Choose Posting--</option>
                                @foreach ($statusPost as $key => $item)
                                    <option
                                        {{ old('posting', $galleryCategory->published) == $key ? 'selected' : '' }}
                                        value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('published')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="mb-2">
                            <label for="status" class="form-label">Status<i class="text-danger">*</i> </label>
                            <select name="status" id="status" class="from-control form-select select2">
                                <option value="">--Choose Status--</option>
                                @foreach ($status as $key => $item)
                                    <option
                                        {{ old('status', $galleryCategory->status) == $key ? 'selected' : '' }}
                                        value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('admin.gallery-category.index') }}">Back</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
@endpush
