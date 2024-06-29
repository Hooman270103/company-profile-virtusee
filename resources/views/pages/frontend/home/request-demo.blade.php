@extends('layouts.frontend.app')


@section('content')

@include('layouts.frontend.components.navbar')
<!-- Breadcrumb section start -->
<section class="breadcrumb-section">
    <div class="bg-shape">
        <div class="shape-img img-1"><img src="{{ asset('assets_frontend') }}/images/shape/breadcrumb-shape1.svg"
                alt="shape" /></div>
        <div class="shape-img img-2"><img src="{{ asset('assets_frontend') }}/images/shape/breadcrumb-shape2.svg"
                alt="shape" /></div>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="breadcrumb-content">
                    <div class="breadcrumb-sec">
                        <h1 class="breadcrumb-title">Request Demo</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumb-img">
                    <img src="{{ asset('assets_frontend') }}/images/shape/breadcrumb-img.svg" alt="breadcrumb-img" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb section end -->

<!-- contact section start -->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <div class="contact-img">
                    <img src="{{ asset('assets_frontend') }}/images/contact/contact-img.png" alt="contact-img" />
                    <div class="overlay-item shape-1">
                        <img src="{{ asset('assets_frontend') }}/images/contact/shape-1.svg" alt="shape-img" />
                        <div class="icon">
                            <img src="{{ asset('assets_frontend') }}/images/icons/sms-tracking-2.svg" alt="icon" />
                        </div>
                    </div>
                    <div class="overlay-item shape-2">
                        <img src="{{ asset('assets_frontend') }}/images/contact/shape-2.svg" alt="shape-img" />
                        <div class="icon">
                            <img src="{{ asset('assets_frontend') }}/images/icons/call-outgoing.svg" alt="icon" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="contact-content">
                    <div class="section-title">
                        <span class="sub-title">Formulir Request Demo</span>
                        <h2 class="title">Mohon Melengkapi Data Terlebih dahulu</h2>
                    </div>
                    <div class="contact-content-body">
                        <form action="{{ route('request-demo.store') }}" method="post">
                            @csrf
                            <div class="form-input-between">
                                <div class="form-input mb-20">
                                    <label for="name">Nama Anda *</label>
                                    <input type="text" name="name" id="name" placeholder="Roe Smith"
                                        value="{{ old('name', $customer->name) }}" required />
                                </div>

                            </div>
                            <div class="form-input-between">
                                <div class="form-input mb-20">
                                    <label for="phone">Nomor Whatsapp *</label>
                                    <input type="text" name="phone" id="phone" placeholder="088239473xxxx"
                                        value="{{ old('phone', $customer->phone) }}" required />
                                </div>
                                <div class="form-input mb-20">
                                    <label for="email">Email *</label>
                                    <input type="email" name="email" id="email" placeholder="example@mail.com"
                                        value="{{ old('email', $customer->email) }}" required />
                                </div>
                            </div>
                            <div class="mb-20">
                                <label for="gender">JENIS KELAMIN * </label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gender1" checked
                                        value="1">
                                    <label class="form-check-label" for="gender1">
                                        Perempuan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gender2" value="2">
                                    <label class="form-check-label" for="gender2">
                                        Laki-Laki
                                    </label>
                                </div>
                            </div>

                            <div class="form-input-between">
                                <div class="form-input mb-20">
                                    <label for="phone">Alamat</label>
                                    <textarea name="address" id="address" cols="2" rows="2"
                                        placeholder="Jl. Kebon jeruk no. 12">{{ old('address', $customer->address) }}</textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="form-input-between">
                                <div class="form-input mb-20">
                                    <label for="company_name">Nama Perusahaan *</label>
                                    <input type="text" name="company_name" id="company_name"
                                        placeholder="PT. Lorem Ipsum"
                                        value="{{ old('company_name', $customer->company_name) }}" required />
                                </div>
                                <div class="form-input mb-20">
                                    <label for="title">Jabatan *</label>
                                    <input type="text" name="title" id="title" placeholder="HRD"
                                        value="{{ old('title', $customer->title) }}" required />
                                </div>
                            </div>
                            <div class="form-input-between">
                                <div class="form-input mb-20">
                                    <label for="company_phone">Nomor Telp Perusahaan *</label>
                                    <input type="text" name="company_phone" id="company_phone"
                                        placeholder="(031) 76383 33"
                                        value="{{ old('company_phone', $customer->company_phone) }}" required />
                                </div>
                                <div class="form-input mb-20">
                                    <label for="company_email">Email Perusahaan *</label>
                                    <input type="email" name="company_email" id="company_email"
                                        placeholder="example@mail.com"
                                        value="{{ old('company_email', $customer->company_email) }}" required />
                                </div>
                            </div>
                            <div class="form-input-between">
                                <div class="form-input mb-20">
                                    <label for="province_id">Provinsi Perusahaan *</label>
                                    <select class="from-control select2" name="province_id" id="province_id">
                                        <option value="" selected disabled>--Pilih Provinsi--</option>
                                        @foreach ($province as $key => $items)
                                        <option value="{{ $items->id }}">{{ $items->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-input mb-20">
                                    <label for="regency_id">Kota/Kab Perusahaan *</label>
                                    <select class="from-control select2" name="regency_id" id="regency_id">
                                        <option value="" selected disabled>--Pilih Kota/Kabupaten--</option>
                                    </select>
                                </div>
                                <div class="form-input mb-20">
                                    <label for="district_id">Kecamatan Perusahaan</label>
                                    <select class="from-control select2" name="district_id" id="district_id">
                                        <option value="" selected disabled>--Pilih Kecamatan--</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-input-between">
                                <div class="form-input mb-30">
                                    <label for="company_address">Alamat Detail Perusahaan *</label>
                                    <textarea name="company_address" id="company_address" cols="2" rows="2"
                                        placeholder="Jl. Kebon jeruk no. 12"
                                        required>{{ old('company_address', $customer->company_address) }}</textarea>
                                </div>
                            </div>
                            <div class="form-input-between">
                                <div class="form-input mb-30">
                                    <label for="know_where">Mengetahui Virtusee Darimana?</label>
                                    <input type="text" name="know_where" id="know_where"
                                        value="{{ old('know_where', $customer->know_where) }}">
                                </div>
                            </div>
                            <div class="form-input-between">

                                <div class="form-input mb-30">
                                    <label for="description">Kebutuhan Perusahaan yang diinginkan *</label>
                                    <textarea name="description" id="description" cols="2" rows="5"
                                        placeholder="Monitoring Sales"
                                        required>{{ old('description', $customer->description) }}</textarea>
                                </div>
                            </div>
                            <div class="form-input-between">

                                <div class="form-input mb-30">
                                    <label for="description">Jadwalkan Meeting Dengan Customer Support *</label>
                                    <input type="datetime-local" name="schedule" id="schedule"
                                        value="{{ old('schedule', $customer->schedule) }}">
                                </div>
                            </div>
                            <div class="mb-30">
                                <p for="description">Apakah Anda Bersedia Untuk Menerima Pesan dari Customer Service
                                    Virtusee Berupa Promosi Virtusee?</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marketing_contact"
                                        id="flexRadioDefault1" value="1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Ya
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="marketing_contact"
                                        id="flexRadioDefault2" value="2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                            <div class="item-button">
                                <input type="submit" class="theme-btn primary-bg" value="Submit" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact section end -->
@endsection

@push('js')
<script>
    $(document).ready(function () {
       
        $('#province_id').change(function () {
            getRegency($('#province_id').val());
        });

        $('#regency_id').change(function () {
            getDistrict($('#regency_id').val());
        });

        $('#district_id').change(function () {
            getVillage($('#district_id').val());
        });
      
    });

    function getRegency(id) {
        $.ajax({
            url: "{{ url('get-regency') }}/" + id,
            success: function (data) {
                let html = '';
                data.forEach(element => {
                    html += `<option value="${element.id}" selected>${element.name}</option>`;
                });
                html += '<option value="" disabled selected>--Pilih Kab/Kota--</option>';
                $('#regency_id').append(html);
            }
        });
    }

    function getDistrict(id){
        $.ajax({
            url: "{{ url('get-district') }}/" + id,
            success: function (data) {
                let html = '';
                data.forEach(element => {
                    html += `<option value="${element.id}" selected>${element.name}</option>`;
                });
                html += '<option value="" disabled selected>--Pilih Kecamatan--</option>';
                $('#district_id').append(html);
            }
        });
    }

    function getVillage(id) {
        $.ajax({
            url: "{{ url('get-village') }}/" + id,
            success: function (data) {
                let html = '';
                data.forEach(element => {
                    html += `<option value="${element.id}" selected>${element.name}</option>`;
                });
                html += '<option value="" disabled selected>--Pilih Desa--</option>';
                $('#village_id').append(html);
            }
        });
    }
</script>
@endpush