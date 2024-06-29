@extends('layouts.app')

@push('title')
    Customers
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
