@extends('layouts.app')

@push('title')
Counter Data
@endpush


@section('content')
<div class="card">
  <div class="card-body">
    <div class="border p-4">
      @if(Route::is('admin.counter.create'))
      <form action="{{ route('admin.counter.store') }}" method="POST">
        @else
        <form action="{{ route('admin.counter.update', $counter->id) }}" method="POST">
          @method('PUT')
          @endif
          @csrf
          <div class="row">
            <div class="col-lg-12 col-sm-12">
              <div class="mb-2">
                  <label for="name" class="form-label" >Title <i class="text-danger">*</i> </label>
                  <textarea name="title" id="title" cols="5" rows="5" class="form-control" >{{ old('title', $counter->title) }}</textarea>
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
                          if (isset($counter)) {
                              foreach ($counter->MenuCounter as $key => $value) {
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
                <select name="posting" id="posting" class="form-control form-select select2">
                  <option value="">--Choose Posting--</option>
                  @foreach ($statusPost as $key => $item)
                  <option {{ old('posting', $counter->published) == $key ? 'selected' : '' }}
                    value="{{ $key }}">{{ $item }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('published')" class="mt-2" />
              </div>
            </div>
            <div class="col-lg-6 col-sm-12">
              <div class="mb-2">
                <label for="status" class="form-label">Status<i class="text-danger">*</i> </label>
                <select name="status" id="status" class="form-control form-select select2">
                  <option value="">--Choose Status--</option>
                  @foreach ($status as $key => $item)
                  <option {{ old('status', $counter->status) == $key ? 'selected' : '' }}
                    value="{{ $key }}">{{ $item }}</option>
                  @endforeach
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
              </div>
            </div>

            <div class="col-lg-12 col-sm-12">
              <div class="mb-2">
                  <div id="div-logo-table">
                      <table class="table table-borderless align-middle table-nowrap mb-0">
                          <thead>
                              <tr>
                                <th class="col">Title</th>
                                <th class="col">Number</th>
                                 <th scope="col">
                                      <button type="button" class="btn btn-rounded btn-primary btn-sm" onclick="addButton()">
                                          <i class="ri-add-circle-line"></i>
                                      </button>
                                  </th>
                              </tr>
                          </thead>
                      </table>
                  </div>
              </div>
          </div>
          </div>

          <div class="text-end">
            <button class="btn btn-primary">Submit</button>
            <a class="btn btn-secondary" href="{{ route('admin.counter.index') }}">Back</a>
          </div>
        </form>
    </div>
  </div>
</div>
@endsection


@push('js')
<script>
  $( document ).ready(function() {
        let id =  {!! json_encode($counter->id) !!} ?? null;
        $.ajax({
            url : "{{ url('admin/counter/get-table') }}",
            data : {id:id},
            success : function (data) {
                $('#div-logo-table').html(data);
            }
        });
    });
</script>
@endpush