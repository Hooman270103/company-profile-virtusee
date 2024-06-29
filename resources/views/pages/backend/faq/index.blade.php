@extends('layouts.app')

@push('title')
    FAQ
@endpush

@push('action')
    <a href="{{ route('admin.faq.create') }}" type="button"
        class="btn btn-primary waves-effect waves-light material-shadow-none">
        <i class="ri-add-circle-line"></i> Add Items
    </a>
@endpush

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table(['class' => 'table table-hover table-bordered align-middle mb-0', 'id' => 'table-id']) }}
            </div>
        </div>
    </div>
@endsection


@push('js')
    {{ $dataTable->scripts() }}
    <script>
        function deleteData(id) {
            Swal.fire({
                title: 'Apakah anda Yakin?',
                text: "Klik 'OK' jika ingin menghapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#cancel_' + id).submit();
                }
            })
        }
    </script>
@endpush
