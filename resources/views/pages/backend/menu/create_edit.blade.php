@extends('layouts.app')

@push('title')
  Menus
@endpush


@section('content')
  <div class="card">
    <div class="card-body">
        <div class="border p-4">
          @if(Route::is('admin.menu.create'))
              <form action="{{ route('admin.menu.store') }}" method="POST" >
          @else
              <form action="{{ route('admin.menu.update', $menu->id) }}" method="POST" >
                @method('PUT')
          @endif
              @csrf
                  <div class="mb-2">
                    <label for="name" class="form-label" >Name <i class="text-danger">*</i> </label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $menu->name) }}" placeholder="Name" >
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-2">
                    <label for="slug" class="form-label">Set Url (slug) ?</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="0" id="check-slug" {{ $menu->slug != null ? 'checked' : '' }}>
                      <label class="form-check-label" for="check-slug" id="label-slug">
                        Yes
                      </label>
                    </div>

                    <div class="border p-2 mt-2" id="slug_div"  hidden="true">
                      <input type="text" name="slug" id="slug" class="form-control" placeholder="Url" value="{{ old('slug', $menu->slug) }}">
                      <small>It is prohibited to use spaces and capital letters</small>
                    </div>
                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />

                </div>
                <div class="mb-2">
                    <label class="form-label" for="position">Position Menu <i class="text-danger">*</i> </label>
                    <input type="number" name="position" id="position" class="form-control" value="{{ old('position', $menu->position) }}"  placeholder="1">
                    <small>Position Must be Unique</small>
                    <x-input-error :messages="$errors->get('position')" class="mt-2" />
                </div>
                <div class="mb-2">
                      <label for="status" class="form-label">Status<i class="text-danger">*</i> </label>
                      <select name="status" id="status" class="from-control form-select select2">
                          <option value="">--Choose Status--</option>
                          @foreach ($status as $key => $item)
                              <option {{ old('status', $menu->status) == $key ? 'selected' : '' }}
                                value="{{ $key }}">{{ $item }}</option>
                          @endforeach
                      </select>
                      <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
                

                <div class="mb-2">
                    <label for="type" class="form-label">Type<i class="text-danger">*</i> </label>
                    <select name="type" id="type" class="from-control form-select select2">
                        <option value="">--Choose Type--</option>
                        @foreach ($menuType as $key => $item)
                            <option {{ old('type', $menu->type) == $key ? 'selected' : '' }}
                              value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <div class="border p-2 mt-2" id="url_div" hidden="true">
                  <div class="mb-2">
                      <label for="type" class="form-label">Link URL<i class="text-danger">*</i> </label>
                      <input type="text" name="link_url" id="link_url" class="form-control" value="{{ old('link_url', $menu->link_url) }}"  placeholder="Enter Link Address" >
                  </div>
                </div>

                <div class="mb-2">
                  <label for="parent_id" class="form-label">Parent</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="0" id="check-parent" {{ $menu->parent_id != null ? 'checked' : '' }}>
                    <label class="form-check-label" for="check-parent" id="label-parent">
                      Yes
                    </label>
                  </div>
                  <div class="border p-2 mt-2" id="parent_div" hidden="true">
                    <select name="parent_id" id="parent_id" class="form-select select2">
                        <option value="" selected>--Choose Parent--</option>
                        @foreach ($allMenu as $item)
                            <option {{ old('parent_id', $menu->parent_id) == $item->id ? 'selected' : '' }}
                              value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                  </div>

                  <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
              </div>
                <div class="text-end">
                    <button class="btn btn-primary">Submit</button>
                    <a class="btn btn-secondary" href="{{ route('admin.menu.index') }}">Back</a>
                </div>
            </form>
        </div>
    </div>
  </div>
@endsection


@push('js')
<script>
    $( document ).ready(function() {
        $('#check-slug').click(function() {
          if ($('#check-slug').prop('checked')) {
              $("#slug_div").attr("hidden", false);
              $('#label-slug').text('No');
          }
          else{
              $("#slug_div").attr("hidden", true);
              $('#label-slug').text('Yes');
          }
        });

      

        $('#type').change(function () {
            let val = $(this).val();
            if (val == 2) {
                $("#url_div").attr("hidden", false);
            }
            else{
              $("#url_div").attr("hidden", true);
            }
        });

        $('#type').trigger('change');

        if ($('#check-slug').prop('checked')) {
            $("#slug_div").attr("hidden", false);
            $('#label-slug').text('No');
        }
        else{
            $("#slug_div").attr("hidden", true);
            $('#label-slug').text('Yes');
        }

        $('#check-parent').click(function() {
          if ($('#check-parent').prop('checked')) {
              $("#parent_div").attr("hidden", false);
              $('#label-parent').text('No');
          }
          else{
              $("#parent_div").attr("hidden", true);
              $('#label-parent').text('Yes');
          }
        });

        if ($('#check-parent').prop('checked')) {
              $("#parent_div").attr("hidden", false);
              $('#label-parent').text('No');
        }
        else{
            $("#parent_div").attr("hidden", true);
            $('#label-parent').text('Yes');
        }
    });
</script>
@endpush
