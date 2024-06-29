@extends('layouts.app')

@push('title')
  Videos
@endpush


@section('content')
  <div class="card">
    <div class="card-body">
        <div class="border p-4">
          @if(Route::is('admin.videos.create'))
              <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" >
          @else
              <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" enctype="multipart/form-data" >
                @method('PUT')
          @endif
              @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="mb-2">
                            <label for="name" class="form-label" >Title <i class="text-danger">*</i> </label>
                            <textarea name="title" id="title" cols="5" rows="5" class="form-control" >{{ old('title', $video->title) }}</textarea>
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                      <div class="mb-2">
                          <label for="name" class="form-label" >Link Video <i class="text-danger">*</i> </label>
                          <input type="text" name="link" id="link" class="form-control" value="{{ old('link', $video->link) }}" >
                          <x-input-error :messages="$errors->get('title')" class="mt-2" />
                      </div>
                  </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="mb-2">
                            <label for="menus" class="form-label">Menus <i class="text-danger">*</i></label>
                            <select name="menus[]" id="menus" class="form-select select2" multiple="multiple">
                                <option value="" disabled>--Choose Menu--</option>
                                @php
                                  $array = [];
                                  if (isset($video)) {
                                      foreach ($video->MenuVideo as $key => $value) {
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
                              <option {{ old('posting', $video->published) == $key ? 'selected' : '' }}
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
                                    <option {{ old('status', $video->status) == $key ? 'selected' : '' }}
                                      value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('admin.videos.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection


@push('js')
<script>
</script>
@endpush
