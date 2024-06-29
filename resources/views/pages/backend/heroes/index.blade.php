@extends('layouts.app')

@push('title')
    Heroes
@endpush


@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.heroes.update', $heroes->id) }}" method="POST" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $heroes->title) }}"
                        placeholder="Enter title">
                </div>
                <div class="mb-2">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="content" id="description" class="form-control" cols="5" rows="5">{{ old('description', $heroes->description) }}</textarea>
                </div>
                <div class="row mb-2">
                    <div class="col-lg-9 col-sm-12">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control" value="{{ old('image', $heroes->image)  }}" >
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        @if ($heroes->image != null)
                            <img src="data:image/png;base64,{{ getStorage($heroes->image) }}" alt="Logo Primary" class="img-thumbnail">
                        @endif
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
