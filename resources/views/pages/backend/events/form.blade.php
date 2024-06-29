@extends('layouts.app')

@push('title')
    News
@endpush


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="border p-4">
                <div class="row">
                    <input type="hidden" name="eventId" id="eventId" value="{{ isset($event) ? $event->id : '' }}">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title <i class="text-danger">*</i></label>
                            <x-text-input id="title" name="title" value="{{ isset($event) ? $event->title : '' }}"
                                type="text" placeholder="{{ __('Title') }}" />
                            <span class="text-danger error-field mt-2 error-title"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Image @if (Route::is('admin.events.create'))
                                    <i class="text-danger">*</i>
                                @elseif (Route::is('admin.events.edit'))
                                    <i class="text-muted">Ignore if not changed</i>
                                @endif
                            </label>
                            <x-text-input id="image" name="image" type="file" placeholder="{{ __('Image') }}" />
                            <small class="d-block">Type File must be png, jpg, jpeg & max size 2mb</small>
                            <span class="text-danger error-field mt-2 error-image"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="slug" class="form-label">Set Url (slug) ? <small class="showLableSlug"
                                    style="display: {{ isset($event) && $event->slug != null ? '' : 'none' }}">It is
                                    prohibited to use spaces
                                    and capital letters</small></label>
                            <div class="d-flex gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="0" id="check-slug"
                                        {{ isset($event) && $event->slug != null ? 'checked' : '' }}>
                                    <label class="form-check-label" for="check-slug" id="label-slug">
                                        Yes
                                    </label>
                                </div>

                                <div class="w-75" id="slug_div" hidden="true">
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        placeholder="Url" value="{{ isset($event) ? $event->slug : '' }}">

                                </div>
                            </div>
                            <span class="text-danger error-field mt-2 error-slug"></span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="menus" class="form-label">Menus <i class="text-danger">*</i></label>
                            <select name="menus" id="menus" class="form-select select2" multiple>
                                <option value="" disabled>--Choose Menu--</option>
                                @php
                                    $array = [];
                                    if (isset($event)) {
                                        foreach ($event->menu_event as $key => $value) {
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
                            <span class="text-danger error-field mt-2 error-menus"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="location" class="form-label">Location <i class="text-danger">*</i></label>
                            <x-text-input type="text" id="location" name="location"
                                value="{{ isset($event) ? $event->location : '' }}" placeholder="{{ __('Location') }}" />
                            <span class="text-danger error-field mt-2 error-location"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="schedule" class="form-label">Schedule <i class="text-danger">*</i></label>
                            <x-text-input type="datetime-local" id="schedule" name="schedule"
                                value="{{ isset($event) ? $event->schedule : '' }}" placeholder="{{ __('Schedule') }}" />
                            <span class="text-danger error-field mt-2 error-schedule"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="pic" class="form-label">PIC</label>
                            <x-text-input type="text" id="pic" name="pic"
                                value="{{ isset($event) ? $event->pic : '' }}" placeholder="{{ __('PIC') }}" />
                            <span class="text-danger error-field mt-2 error-pic"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Phone PIC</label>
                            <x-text-input type="text" id="phone" name="phone"
                                value="{{ isset($event) ? $event->phone : '' }}" placeholder="{{ __('Phone PIC') }}" />
                            <span class="text-danger error-field mt-2 error-phone"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="posting" class="form-label">Posting<i class="text-danger">*</i> </label>
                            <select name="posting" id="posting" class="from-control form-select select2">
                                <option value="">--Choose Posting--</option>
                                @foreach ($statusPublish as $key => $item)
                                    <option value="{{ $key }}"
                                        {{ isset($event) && $event->published == $key ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger error-field mt-2 error-posting"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status<i class="text-danger">*</i> </label>
                            <select name="status" id="status" class="from-control form-select select2">
                                <option value="">--Choose Status--</option>
                                @foreach ($status as $key => $item)
                                    <option value="{{ $key }}"
                                        {{ isset($event) && $event->status == $key ? 'selected' : '' }}>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-field mt-2 error-status"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description<i class="text-danger">*</i> </label>
                            <textarea name="content" id="description" class="form-control">{{ isset($event) ? $event->description : '' }}</textarea>
                            <span class="text-danger error-field mt-2 error-description"></span>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    @if (!Route::is('admin.events.show'))
                        <button class="btn btn-primary btnSubmit" type="button"
                            onclick="handlerSubmit(event)">Submit</button>
                    @endif
                    <a class="btn btn-secondary" href="{{ route('admin.events.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        // CKEDITOR.replace('content');
        const eventId = $("#eventId").val();

        $('#check-slug').click(function() {
            if ($('#check-slug').prop('checked')) {
                $("#slug_div").attr("hidden", false);
                $('#label-slug').text('No');
                $(".showLableSlug").show();
            } else {
                $("#slug_div").attr("hidden", true);
                $('#label-slug').text('Yes');
                $(".showLableSlug").hide();
            }
        });

        if ($('#check-slug').prop('checked')) {
            $("#slug_div").attr("hidden", false);
            $('#label-slug').text('No');
            $(".showLableSlug").show();
        } else {
            $("#slug_div").attr("hidden", true);
            $('#label-slug').text('Yes');
            $(".showLableSlug").hide();
        }

        const handlerSubmit = (event) => {
            const token_file = "{{ csrf_token() }}";
            const title = $('#title').val();
            const image = $('#image');
            const menus = $('#menus').val();
            const location = $('#location').val();
            const schedule = $('#schedule').val();
            const pic = $('#pic').val();
            const phone = $('#phone').val();
            const posting = $('#posting option:selected').val();
            const status = $('#status option:selected').val();
            const description = $("#description").val();
            const checkSlug = $("#check-slug").is(":checked");
            const slug = $("#slug").val();

            const fieldValidation = [{
                    field: "title",
                    type: "string",
                    validation: ['required', 'max:255', 'min:10'],
                    value: title
                },
                {
                    field: "image",
                    type: "file",
                    validation: [],
                    value: image
                },
                {
                    field: "menus",
                    type: "array",
                    validation: ['required'],
                    value: menus
                },
                {
                    field: "location",
                    type: "string",
                    validation: ['required'],
                    value: location
                },
                {
                    field: "schedule",
                    type: "datetime",
                    validation: ['required', 'datetime'],
                    value: schedule
                },
                {
                    field: "pic",
                    type: "string",
                    validation: [],
                    value: pic
                },
                {
                    field: "phone",
                    type: "number",
                    validation: ['numeric', 'min:10', 'max:15'],
                    value: phone
                },
                {
                    field: "posting",
                    type: "string",
                    validation: ['required'],
                    value: posting
                },
                {
                    field: "status",
                    type: "string",
                    validation: ['required'],
                    value: status
                },
                {
                    field: "description",
                    type: "string",
                    validation: ['required'],
                    value: description
                },
            ]

            if (eventId) {
                fieldValidation[1]['validation'] = ['mimes:png,jpg,jpeg,gif', 'size:2048']
            } else {
                fieldValidation[1]['validation'] = ['required', 'mimes:png,jpg,jpeg,gif', 'size:2048']
            }

            if (checkSlug) {
                fieldValidation.push({
                    field: "slug",
                    type: "string",
                    validation: ['required', 'alpha_dash'],
                    value: slug
                })
            }

            if (setValidation(fieldValidation) > 0) {
                messageTopRight('error', 'There is an error in the field, check the field again!');
                return;
            };

            var formData = new FormData();

            formData.append('title', title);
            formData.append('image', image[0].files[0]);
            formData.append('menus', menus);
            formData.append('location', location);
            formData.append('schedule', schedule);
            formData.append('pic', pic);
            formData.append('phone', phone);
            formData.append('posting', posting);
            formData.append('status', status);
            formData.append('description', description);
            if (checkSlug) {
                formData.append("slug", slug)
            }
            if (eventId) {
                formData.append("_method", "PUT");
            }

            let urlRequest = eventId ? "{{ route('admin.events.update', ':id') }}" :
                "{{ route('admin.events.store') }}";
            urlRequest = urlRequest.replace(':id', eventId);

            requestAjax(urlRequest, {
                dataForm: formData,
            }, "POST", "JSON", function(response) {
                if (response.status) {
                    window.location.href = "{{ route('admin.events.index') }}";
                } else {
                    messageTopRight('error', response.message);
                }
            }, ".btnSubmit", "Submit", "multipart-formdata");
        }
    </script>
@endpush
