@extends('layouts.app')

@push('title')
    Logo Slider
@endpush

@push('action')
    <button type="button" class="btn btn-danger waves-effect waves-light material-shadow-none"
        onclick="handlerDeleteAllData()">
        <i class="ri-delete-bin-fill"></i> Delete All
    </button>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.logo-sliders.store') }}" method="POST" enctype="multipart/form-data"
                class="dropzone" id="image-upload" style="border: 2px rgba(0,0,0,0.3) dashed !important">
                @csrf
            </form>
        </div>
    </div>

    <div class="card .mt-4">
        <div class="card-header">
            <h4 class="card-title mb-0">Logo Sliders</h4>
            <span class="text-muted">Draggable card to change position image</span>
        </div><!-- end card header -->

        <div class="card-body p-3">
            <div class="row align-items-center justify-content-center gallery-sliders gap-3"></div>
        </div>
        <!-- end card body -->
    </div>
@endsection


@push('js')
    <script>
        $(document).ready(function() {
            getHeroSliders();
        })

        Dropzone.options.imageUpload = {
            maxFilesize: 2,
            acceptedFiles: ".jpeg,.jpg,.png",
            dictDefaultMessage: `<div class="mb-3"><i class="display-2 text-muted ri-image-add-fill"></i></div>
                                 <h5>Upload image or drag and drop</h5>
                                 <h6 class="text-muted">JPG or PNG up to 2 MB</h6>`,
            init: function() {
                this.on("success", function(file) {
                    if (file.status === "success") {
                        setTimeout(() => {
                            this.removeFile(file)
                            setTimeout(() => getHeroSliders(), 1000);
                        }, 1200);
                    }
                });
                this.on("addedfile", function(file) {
                    if (file.size > this.options.maxFilesize * 1024 * 1024) {
                        var errorMessage = "File terlalu besar. Ukuran maksimum adalah " + this.options
                            .maxFilesize + " MB.";
                        file.previewElement.querySelector(".dz-error-message").textContent = errorMessage;
                    }
                });
            }
        };

        const getHeroSliders = () => {
            $(".gallery-sliders").html('');
            $(".gallery-sliders").html(setLoading());
            let html = "";
            requestAjax(`{{ route('admin.logo-sliders.all-data') }}`, {}, 'GET', 'JSON', function(response) {
                $(".gallery-sliders").html('');
                if (response.length > 0) {
                    response.map((value) => {
                        html += `
                            <div class="col-xl-3 col-md-3 col-lg-3 col-sm-12 shadow-xl rounded-4 hero-slider cursor-pointer" data-id="${value.id}" style="background-image: url('${value.image}'); background-size: cover; background-position: center;min-height:30vh;position:relative">
                                <i class="ri-delete-bin-fill text-danger fs-5 shadow-lg position-absolute cursor-pointer py-1 px-2 text-white bg-danger rounded-2" style="top:5px; right:8px" onclick="handlerDeleteData('${value.id}')"></i>
                            </div>
                        `;
                    })
                } else {
                    html += `
                        <div class="col-xl-12">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/wwmtsdzm.json" trigger="loop" delay="1500" style="width:150px;height:150px"></lord-icon>
                                <h3 class="fw-semibold" style="letter-spacing: 2px">Data Empty</h3>
                            </div>    
                        </div>
                    `;
                }
                $(".gallery-sliders").html(html)
            });

            // Initialize SortableJS
            const sortable = new Sortable(document.querySelector('.gallery-sliders'), {
                animation: 150,
                onEnd: function(evt) {
                    const items = Array.from(document.querySelectorAll('.hero-slider'));
                    const positions = items.map((item, index) => {
                        return {
                            id: parseInt(item.getAttribute('data-id')),
                            position: index + 1
                        };
                    });

                    requestAjax(`{{ route('admin.logo-sliders.update-position') }}`, {
                        positions
                    }, 'POST', 'JSON', function(response) {})
                },
            });
        }

        const handlerDeleteAllData = () => {

            messageBoxBeforeRequest('Want to delete all?', 'Yes. Sure', 'No, Close').then((
                result) => {
                if (result.isConfirmed) {
                    requestAjax(`{{ url('/admin/logo-sliders/destroy-all') }}`, {},
                        'DELETE', 'JSON',
                        function(response) {
                            if (response.status) {
                                messageTopRight('success', response.message)
                                setTimeout(() => getHeroSliders(), 700)
                            } else {
                                messageTopRight('error', response.message)
                            }
                        })
                }
            })
        }

        const handlerDeleteData = (id) => {
            requestAjax(`{{ url('/admin/logo-sliders/destroy/${id}') }}`, {},
                'DELETE', 'JSON',
                function(response) {
                    if (response.status) {
                        messageTopRight('success', response.message)
                        setTimeout(() => getHeroSliders(), 700)
                    } else {
                        messageTopRight('error', response.message)
                    }
                })
        }
    </script>
@endpush
