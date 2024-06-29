@extends('layouts.app')

@push('title')
Customers
@endpush


@section('content')
<div class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-lg-6 col-sm-12 mb-3">
                <h5 class="text-primary">Personal Data</h5>
                <table class="table table-hover table-bordered align-middle mb-0">
                    <tbody>
                        <tr>
                            <td>
                                <label class="fw-bold" for="name">Name</label>
                            </td>
                            <td>
                                {{ $customer->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="gender">Gender</label>
                            </td>
                            <td>
                                {{ $customer->gender == '1' ? 'Female' : 'Male' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="email">Email</label>
                            </td>
                            <td>
                                {{ $customer->email }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="phone">Phone</label>
                            </td>
                            <td>
                                {{ $customer->phone }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="address">Address</label>
                            </td>
                            <td>
                                {{ $customer->address }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="title">Title</label>
                            </td>
                            <td>
                                {{ $customer->title }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6 col-sm-12 mb-3">
                <h5 class="text-primary">Company Data</h5>
                <table class="table table-hover table-bordered align-middle mb-0">
                    <tbody>
                        <tr>
                            <td>
                                <label class="fw-bold" for="company_name">Company Name</label>
                            </td>
                            <td>
                                {{ $customer->company_name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="company_phone">Company Phone</label>
                            </td>
                            <td>
                                {{ $customer->company_phone }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="company_email">Company Email</label>
                            </td>
                            <td>
                                {{ $customer->company_email }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="province_id">Province</label>
                            </td>
                            <td>
                                {{ $customer->province_id != null ? $customer->Province->name : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="regency_id">Regency</label>
                            </td>
                            <td>
                                {{ $customer->regency_id != null ? $customer->Regency->name : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="district_id">District</label>
                            </td>
                            <td>
                                {{ $customer->district_id != null ? $customer->District->name : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="village_id">Village</label>
                            </td>
                            <td>
                                {{ $customer->village_id != null ? $customer->Village->name : '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="fw-bold" for="company_address">Company Address</label>
                            </td>
                            <td>
                                {{ $customer->company_address }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 col-sm-12">

            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle mb-0">
                <tbody>
                    <tr>
                        <td style="width: 50%">
                            <label class="fw-bold" for="know_where">How do you know about Virtusee?</label>
                        </td>
                        <td>
                            {{ $customer->know_where }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="fw-bold" for="description">Description</label>
                        </td>
                        <td>
                            {{ $customer->description }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="fw-bold" for="description">Schedule a meeting with Customer Service</label>
                        </td>
                        <td>
                            {{ $customer->schedule }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="fw-bold" for="description">Are you willing to receive messages from Virtusee Customer Service in the form of Virtusee promotions?</label>
                        </td>
                        <td>
                            {{ $customer->marketing_contact == '1' ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="text-end mt-3">
            <a class="btn btn-secondary" href="{{ route('admin.customers.index') }}">Back</a>
        </div>
    </div>
</div>
@endsection