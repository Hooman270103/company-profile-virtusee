@extends('layouts.app')

@push('title')
Section
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <div class="border p-4">
            @if (Route::is('admin.section.create'))
                <form action="{{ route('admin.section.store') }}" method="POST" enctype="multipart/form-data" >
            @elseif (Route::is('admin.section.edit'))
                <form action="{{ route('admin.section.update', $section->id) }}" method="POST" enctype="multipart/form-data" >
                @method('PUT')
            @endif
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title <i class="text-danger">*</i></label>
                            <x-text-input id="title" name="title" value="{{ old('title', $section->title) }}"
                                type="text" placeholder="{{ __('Title') }}" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Image @if (Route::is('admin.section.create'))
                                <i class="text-danger">*</i>
                                @elseif (Route::is('admin.section.edit'))
                                    <i class="text-muted">Abaikan jika tidak diubah</i>
                                @endif
                            </label>
                            <x-text-input id="image" name="image" type="file" placeholder="{{ __('Image') }}" />
                            <small class="d-block">Type File must be png, jpg, jpeg & max size 2mb</small>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="mb-2">
                            <label for="menus" class="form-label">Menus <i class="text-danger">*</i></label>
                            <select name="menus[]" id="menus" class="form-select select2" multiple="multiple">
                                <option value="" disabled>--Choose Menu--</option>
                                @php
                                  $array = [];
                                  if (isset($section)) {
                                      foreach ($section->MenuSection as $key => $value) {
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
                    <div class="col-lg-4 col-sm-12">
                        <div class="mb-2">
                            <label for="position" class="form-label">Position<i class="text-danger">*</i> </label>
                            <select name="position" id="position" class="fom-control form-select select2" >
                                <option value="">-- Choose Position --</option>
                                @foreach ($position as $key => $items )
                                    <option {{ old('position', $section->position) == $key ? 'selected' : '' }}
                                        value="{{ $key }}">{{ $items }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="mb-2">
                          <label for="posting" class="form-label">Posting<i class="text-danger">*</i> </label>
                          <select name="posting" id="posting" class="form-control form-select select2">
                            <option value="">--Choose Posting--</option>
                            @foreach ($statusPost as $key => $item)
                            <option {{ old('posting', $section->published) == $key ? 'selected' : '' }}
                              value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                          </select>
                          <x-input-error :messages="$errors->get('published')" class="mt-2" />
                        </div>
                      </div>
                      <div class="col-lg-4 col-sm-12">
                        <div class="mb-2">
                          <label for="status" class="form-label">Status<i class="text-danger">*</i> </label>
                          <select name="status" id="status" class="form-control form-select select2">
                            <option value="">--Choose Status--</option>
                            @foreach ($status as $key => $item)
                            <option {{ old('status', $section->status) == $key ? 'selected' : '' }}
                              value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                          </select>
                          <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                      </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description<i class="text-danger">*</i> </label>
                            <textarea name="content" id="description" class="form-control"
                                class="form-control">{{ old('description', $section->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    @if (!Route::is('admin.section.show'))
                        <button class="btn btn-primary btnSubmit" type="submit">Submit</button>
                    @endif
                    <a class="btn btn-secondary" href="{{ route('admin.section.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection