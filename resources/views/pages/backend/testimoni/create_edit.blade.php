@extends('layouts.app')

@push('title')
  Testimoni
@endpush


@section('content')
<div class="card">
  <div class="card-body">
    <div class="border p-4">
      @if(Route::is('admin.testimoni.create'))
        <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data">
      @else
        <form action="{{ route('admin.testimoni.update', $testimoni->id) }}" method="POST" enctype="multipart/form-data">
          @method('PUT')
      @endif
          @csrf
          <div class="row">
                <div class="col-md-8">
                  <div class="form-group mb-2">
                      <label for="name" class="form-label">Name <i class="text-danger">*</i></label>
                      <x-text-input id="name" name="name" value="{{ old('name', $testimoni->name) }}"
                          type="text" placeholder="{{ __('Name') }}" />
                      <x-input-error :messages="$errors->get('name')" class="mt-2" />
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group mb-2">
                      <label for="email" class="form-label">Image @if (Route::is('admin.testimoni.create'))
                              <i class="text-danger">*</i>
                          @elseif (Route::is('admin.testimoni.edit'))
                              <i class="text-muted">Ignore if not changed</i>
                          @endif
                      </label>
                      <x-text-input id="image" name="image" type="file" placeholder="{{ __('Image') }}" />
                      <small class="d-block">Type File must be png, jpg, jpeg & max size 2mb</small>
                      <x-input-error :messages="$errors->get('image')" class="mt-2" />
                  </div>
              </div>
              <div class="col-lg-12 col-sm-12">
                  <div class="mb-2">
                      <label for="titile" class="form-label" >Title</label>
                      <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $testimoni->title) }}" >
                      <x-input-error :messages="$errors->get('title')" class="mt-2" />
                  </div>
              </div>
              <div class="col-lg-12 col-sm-12">
                  <div class="mb-3">
                      <label class="form-label" for="testimoni">Testimoni <i class="text-danger">*</i> </label>

                      <textarea name="content" id="description" class="form-control">{{ old('testimoni', $testimoni->testimoni) }}</textarea>
                      <x-input-error :messages="$errors->get('testimoni')" class="mt-2" />
                  </div>
              </div>
              <div class="col-lg-12 col-sm-12">
                <div class="mb-2">
                    <label for="menus" class="form-label">Menus <i class="text-danger">*</i></label>
                    <select name="menus[]" id="menus" class="form-select select2" multiple="multiple">
                        <option value="" disabled>--Choose Menu--</option>
                        @php
                          $array = [];
                          if (isset($testimoni)) {
                              foreach ($testimoni->MenuTestimoni as $key => $value) {
                                $array[] = $value->menu_id;
                              }
                          }   
                        @endphp
                        @foreach ($menuRepository as $item)
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
                <label for="published" class="form-label">Posting<i class="text-danger">*</i> </label>
                <select name="published" id="published" class="from-control form-select select2">
                  <option value="">--Choose Posting--</option>
                  @foreach ($statusPost as $key => $item)
                  <option {{ old('published', $testimoni->published) == $key ? 'selected' : '' }}
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
                  <option {{ old('status', $testimoni->status) == $key ? 'selected' : '' }}
                    value="{{ $key }}">{{ $item }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
              </div>
            </div>
          </div>

          <div class="text-end">
            <button class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('admin.testimoni.index') }}">Back</a>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection


@push('js')
@endpush