@extends('layouts.app')

@push('title')
    Users
@endpush


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="border p-4">
                @if (Route::is('admin.users.create'))
                    <form action="{{ route('admin.users.store') }}" method="POST">
                    @else
                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @method('PUT')
                @endif
                @csrf
                <div class="mb-2">
                    <label for="name" class="form-label">Name</label>
                    <x-text-input id="name" name="name" type="text" placeholder="{{ __('Nama') }}"
                        value="{{ old('name', $user->name) }}" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <x-text-input id="email" name="email" type="email" placeholder="{{ __('Email') }}"
                        value="{{ old('email', $user->email) }}" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                @if (!Route::is('admin.users.show'))
                    <div class="mb-2">
                        <label class="form-label" for="password">Password
                            @if (Route::is('admin.users.edit'))
                                <small class="text-muted" style="font-size: 10px">Kosongkan jika tidak dirubah</small>
                            @endif
                        </label>
                        <div class="position-relative auth-pass-inputgroup mb-3">
                            <input type="password" class="form-control pe-5 password" placeholder="{{ __('Password') }}"
                                id="password" name="password" value="{{ old('password') }}">
                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                type="button" onclick="handlerViewPassword(event)"><i
                                    class="ri-eye-fill align-middle icon-password"></i></button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                @endif


                <div class="text-end">
                    @if (!Route::is('admin.users.show'))
                        <button class="btn btn-primary">Submit</button>
                    @endif
                    <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Back</a>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        const handlerViewPassword = (event) => {
            const password = document.querySelector('.password');
            const iconPassword = document.querySelector('.icon-password');

            const showText = document.querySelector('.show-text');
            if (password.getAttribute('type') === 'password') {
                password.setAttribute('type', 'text');
                iconPassword.classList.remove('ri-eye-fill');
                iconPassword.classList.add('ri-eye-off-fill');
            } else {
                password.setAttribute('type', 'password');
                iconPassword.classList.remove('ri-eye-off-fill');
                iconPassword.classList.add('ri-eye-fill');
            }
        }
    </script>
@endpush
