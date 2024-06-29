@extends('layouts.app')

@push('title')
  FAQ
@endpush


@section('content')
<div class="card">
  <div class="card-body">
    <div class="border p-4">
      @if(Route::is('admin.faq.create'))
      <form action="{{ route('admin.faq.store') }}" method="POST">
        @else
        <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
          @method('PUT')
          @endif
          @csrf
          <div class="row">
              <div class="col-lg-12 col-sm-12">
                  <div class="mb-2">
                      <label for="questions" class="form-label">Questions <i class="text-danger">*</i> </label>
                      <input type="text" name="questions" class="form-control" id="questions" value="{{ old('questions', $faq->questions) }}">
                      <x-input-error :messages="$errors->get('questions')" class="mt-2" />
                  </div>
              </div>
              <div class="col-lg-12 col-sm-12">
                  <div class="mb-2">
                      <label for="answers">Ansewers <i class="text-danger">*</i> </label>
                      <textarea class="form-control" name="answers" id="answers" cols="10" rows="10">{{ old('answers', $faq->answers) }}</textarea>
                      <x-input-error :messages="$errors->get('answers')" class="mt-2" />
                  </div>
              </div>
              <div class="col-lg-12 col-sm-12">
                <div class="mb-2">
                    <label for="menus" class="form-label">Menus <i class="text-danger">*</i></label>
                    <select name="menus[]" id="menus" class="form-select select2" multiple="multiple">
                        <option value="" disabled>--Choose Menu--</option>
                        @php
                          $array = [];
                          if (isset($faq)) {
                              foreach ($faq->MenuFaq as $key => $value) {
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
                  <option {{ old('published', $faq->published) == $key ? 'selected' : '' }}
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
                  <option {{ old('status', $faq->status) == $key ? 'selected' : '' }}
                    value="{{ $key }}">{{ $item }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
              </div>
            </div>
          </div>

          <div class="text-end">
            <button class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('admin.faq.index') }}">Back</a>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection


@push('js')
@endpush