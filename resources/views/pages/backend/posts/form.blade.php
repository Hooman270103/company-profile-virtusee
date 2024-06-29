@extends('layouts.app')

@push('title')
    News
@endpush


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="border p-4">
                <div class="row">
                    <input type="hidden" name="postId" id="postId" value="{{ isset($post) ? $post->id : '' }}">
                    <input type="hidden" name="dataTags" id="dataTags"
                        value="{{ isset($post) ? json_encode($post->tags) : '' }}">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Title <i class="text-danger">*</i></label>
                            <x-text-input id="title" name="title" value="{{ isset($post) ? $post->title : '' }}"
                                type="text" placeholder="{{ __('Title') }}" />
                            <span class="text-danger error-field mt-2 error-title"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Image @if (Route::is('admin.posts.create'))
                                @elseif (Route::is('admin.posts.edit'))
                                    <i class="text-muted">Abaikan jika tidak diubah</i>
                                @endif
                            </label>
                            <x-text-input id="image" name="image" type="file" placeholder="{{ __('Image') }}" />
                            <small class="d-block">Type File must be png, jpg, jpeg & max size 2mb</small>
                            <small class="d-block">Type News does not require Images</small>
                            <span class="text-danger error-field mt-2 error-image"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="slug" class="form-label">Set Url (slug) ? <small class="showLableSlug"
                                    style="display: {{ isset($post) && $post->slug != null ? '' : 'none' }}">It is
                                    prohibited to use spaces
                                    and capital letters</small></label>
                            <div class="d-flex gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="0" id="check-slug"
                                        {{ isset($post) && $post->slug != null ? 'checked' : '' }}>
                                    <label class="form-check-label" for="check-slug" id="label-slug">
                                        Yes
                                    </label>
                                </div>

                                <div class="w-75" id="slug_div" hidden="true">
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        placeholder="Url" value="{{ isset($post) ? $post->slug : '' }}">

                                </div>
                            </div>
                            <span class="text-danger error-field mt-2 error-slug"></span>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="menus" class="form-label">Menus <i class="text-danger">*</i></label>
                            <select name="menus" id="menus" class="form-select select2" multiple>
                                <option value="" disabled>Pilih Menu</option>
                                @php
                                    $array = [];
                                    if (isset($post)) {
                                        foreach ($post->menu_post as $key => $value) {
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
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="tags" class="form-label">Tags <i class="text-danger">*</i></label>
                            <input id="tags" name="tags" type="text"
                                placeholder="{{ __('write and enter tags') }}" class="form-control">
                            <span class="text-danger error-field mt-2 error-tags"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="type" class="form-label">Type Posts <i class="text-danger">*</i> </label>
                            <select name="type" id="type" class="from-control form-select select2">
                                <option value="">--Choose Type--</option>
                                @foreach ($postsType as $key => $item)
                                    <option value="{{ $key }}"
                                        {{ isset($post) && $post->type == $key ? 'selected' : '' }}>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-field mt-2 error-type"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="posting" class="form-label">Posting<i class="text-danger">*</i> </label>
                            <select name="posting" id="posting" class="from-control form-select select2">
                                <option value="">--Choose Posting--</option>
                                @foreach ($statusPost as $key => $item)
                                    <option value="{{ $key }}"
                                        {{ isset($post) && $post->published == $key ? 'selected' : '' }}>
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
                                        {{ isset($post) && $post->status == $key ? 'selected' : '' }}>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-field mt-2 error-status"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description<i class="text-danger">*</i> </label>
                            <summernote-wrapper>
                                <textarea name="content" id="description" class="form-control">{{ isset($post) ? $post->description : '' }}</textarea>
                            </summernote-wrapper>
                            <span class="text-danger error-field mt-2 error-description"></span>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-3">
                    @if (!Route::is('admin.posts.show'))
                        <button class="btn btn-primary btnSubmit" type="button"
                            onclick="handlerSubmit(event)">Submit</button>
                    @endif
                    <a class="btn btn-secondary" href="{{ route('admin.posts.index') }}">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        // CKEDITOR.replace('content');
        const tagsArray = [];
        const postId = $("#postId").val();

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

        document.addEventListener('DOMContentLoaded', function() {
            const tagsInput = document.getElementById('tags');
            const tagsContainer = document.createElement('div');
            tagsContainer.classList.add('d-flex', 'flex-wrap', 'mt-2', 'gap-3', 'position-relative');
            tagsInput.parentNode.insertBefore(tagsContainer, tagsInput.nextSibling);

            //edit data
            if (postId) {
                const dataTags = JSON.parse($("#dataTags").val());
                dataTags.forEach(tag => {
                    createTag(tag);
                })
            }

            function createTag(tagName) {
                // Cek apakah tag sudah ada dalam array
                if (tagsArray.includes(tagName)) {
                    return; // Jika sudah ada, abaikan penambahan
                }

                const tagElement = document.createElement('span');
                tagElement.textContent = tagName;
                tagElement.classList.add('badge', 'bg-primary', 'position-relative', 'py-2', 'px-3');

                const deleteButton = document.createElement('span');
                deleteButton.innerHTML = '&times;';
                deleteButton.classList.add('position-absolute', 'cursor-pointer',
                    'text-white');
                deleteButton.style.fontSize = '12px';
                deleteButton.style.backgroundColor = 'red';
                deleteButton.style.padding = '2px 5px';
                deleteButton.style.top = '-5px';
                deleteButton.style.right = '-7px';
                deleteButton.style.borderRadius = '50%';
                deleteButton.addEventListener('click', function() {
                    const index = tagsArray.indexOf(tagName);
                    if (index !== -1) tagsArray.splice(index, 1);
                    tagsContainer.removeChild(tagElement);
                });

                tagElement.appendChild(deleteButton);
                tagsContainer.appendChild(tagElement);
                tagsArray.push(tagName);
            }

            tagsInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    const tagValue = event.target.value.trim();
                    if (tagValue !== '') {
                        createTag(tagValue);
                        event.target.value = '';
                    }
                }
            });
        });

        const handlerSubmit = (event) => {
            const token_file = "{{ csrf_token() }}";
            const title = $('#title').val();
            const image = $('#image');
            const menus = $('#menus').val();
            const type = $('#type option:selected').val();
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
                    validation: ['mimes:png,jpg,jpeg,gif'],
                    value: image
                },
                {
                    field: "tags",
                    type: "array",
                    validation: ['required'],
                    value: tagsArray
                },
                {
                    field: "menus",
                    type: "array",
                    validation: ['required'],
                    value: menus
                },
                {
                    field: "type",
                    type: "string",
                    validation: ['required'],
                    value: type
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

            if (postId) {
                fieldValidation[1]['validation'] = ['mimes:png,jpg,jpeg,gif', 'size:2048']
            } else {
                fieldValidation[1]['validation'] = ['mimes:png,jpg,jpeg,gif', 'size:2048']
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
            }

            var formData = new FormData();

            formData.append('title', title);
            formData.append('image', image[0].files[0] ?? '');
            formData.append('tags', tagsArray);
            formData.append('menus', menus);
            formData.append('type', type);
            formData.append('posting', posting);
            formData.append('status', status);
            formData.append('description', description);
            if (checkSlug) {
                formData.append("slug", slug)
            }
            if (postId) {
                formData.append("_method", "PUT");
            }


            let urlRequest = postId ? "{{ route('admin.posts.update', ':id') }}" :
                "{{ route('admin.posts.store') }}";
            urlRequest = urlRequest.replace(':id', postId);

            requestAjax(urlRequest, {
                dataForm: formData,
            }, "POST", "JSON", function(response) {
                if (response.status) {
                    window.location.href = "{{ route('admin.posts.index') }}";
                } else {
                    messageTopRight('error', response.message);
                }
            }, ".btnSubmit", "Submit", "multipart-formdata");
        }
    </script>
@endpush
