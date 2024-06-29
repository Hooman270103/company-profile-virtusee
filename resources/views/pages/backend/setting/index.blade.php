@extends('layouts.app')

@push('title')
setting
@endpush

@section('content')
<div class="card">
  <div class="card-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-bs-toggle="tab" href="#general" role="tab">
          General
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#logo" role="tab">
          Logo & Favicon
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#sosial" role="tab">
          Social Media
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#mail_setting" role="tab">
          Email
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#warna" role="tab">
          Color Website
        </a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="general" role="tabpanel">
        <form action="{{ route('admin.setting.update', $setting->id) }}" method="POST">
          @csrf
          @method('PUT')

          <input type="hidden" name="type" id="type" value="general">
          <div class="border p-4">
            <div class="mb-2">
              <label for="name" class="form-label">Name Website <i class="text-danger">*</i> </label>
              <input type="text" name="name" id="name" class="form-control"
                value="{{ old('name', $setting->name) }}" placeholder="Nama Website">
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="tagline" class="form-label">Tagline Website</label>
              <input type="text" name="tagline" id="tagline" class="form-control"
                value="{{ old('tagline', $setting->tagline) }}" placeholder="Tagline Website">
              <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="description" class="form-label">Description Website <i class="text-danger">*</i> </label>
              <textarea name="description" id="description" cols="5" rows="5"
                class="form-control">{{ old('description', $setting->description) }}</textarea>
              <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="email" class="form-label">Email Website <i class="text-danger">*</i></label>
              <input type="text" name="email" id="email" class="form-control"
                value="{{ old('email', $setting->email) }}" placeholder="Email Website">
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="no_telp" class="form-label">No Telp Website</label>
              <input type="text" name="no_telp" id="no_telp" class="form-control"
                value="{{ old('no_telp', $setting->no_telp) }}" placeholder="No Telp Website">
              <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="address" class="form-label">Address Website <i class="text-danger">*</i></label>
              <textarea name="address" id="address" cols="5" rows="5"
                class="form-control">{{ old('address', $setting->address) }}</textarea>
              <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>
            <div class="row">
                  <div class="col-lg-8 col-sm-12">
                    <div class="mb-2">
                      <label for="maps_location" class="form-label">Maps Location Website</label>
                      <textarea name="maps_location" id="maps_location" class="form-control" cols="5" rows="7">{{ old('maps_location', $setting->maps_location) }}</textarea>
                      <x-input-error :messages="$errors->get('maps_location')" class="mt-2" />
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-12">
                    <div class="mb-2">
                      <label for="maps_location" class="form-label">Priview</label>
                      <iframe src="{{ $setting->maps_location }}"  width="100%" height="50%" frameborder="0" style="border:1px solid #ccc;"></iframe>
                    </div>
                  </div>
            </div>
            <div class="text-end">
              <button class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
      <div class="tab-pane" id="logo" role="tabpanel">
        <form action="{{ route('admin.setting.update', $setting->id)  }}" method="POST" enctype="multipart/form-data" >
          @csrf
          @method('PUT')
          <input type="hidden" name="type" id="type" value="logo">
          <div class="border p-4">
            <div class="row">
              <div class="col-lg-9 col-sm-9">
                <div class="mb-2">
                  <label for="nama" class="form-label">Logo Primary</label>
                  <input type="file" name="logo_primary" id="logo_primary" class="form-control"
                    value="{{ old('logo_primary', $setting->logo_primary) }}" placeholder="Logo Website Primary">
                     <small>Type File must be png, jpg, jpeg & max size 2mb</small>
                  <x-input-error :messages="$errors->get('logo_primary')" class="mt-2" />
                </div>
                <div class="mb-2">
                  <label for="nama" class="form-label">Logo Secondary </label>
                  <input type="file" name="logo_secondary" id="logo_secondary" class="form-control"
                    value="{{ old('logo_secondary', $setting->logo_secondary) }}" placeholder="Logo Website Secondary" >
                     <small>Type File must be png, jpg, jpeg & max size 2mb</small>
                  <x-input-error :messages="$errors->get('logo_secondary')" class="mt-2" />
                </div>
                <div class="mb-2">
                  <label for="nama" class="form-label">Favicon</label>
                  <input type="file" name="favicon" id="favicon" class="form-control"
                    value="{{ old('favicon', $setting->favicon) }}" placeholder="Logo Favicon">
                     <small>Type File must be png, jpg, jpeg & max size 2mb</small>
                  <x-input-error :messages="$errors->get('favicon')" class="mt-2" />
                </div>
              </div>
              <div class="col-lg-3 col-sm-3">
                <div class="mb-3">
                  <label for="nama" class="form-label">Logo Primary</label>
                  <br>
                  @if (isset($setting->logo_primary))
                    <img src="data:image/png;base64,{{ getStorage($setting->logo_primary) }}" alt="Logo Primary" class="img-thumbnail">
                  @endif
                </div>
                <div class="mb-3">
                  <label for="nama" class="form-label">Logo Secondary</label>
                  <br>
                  @if (isset($setting->logo_secondary))
                    <img src="data:image/png;base64,{{ getStorage($setting->logo_secondary) }}" alt="Logo Secondary" class="img-thumbnail">
                  @endif
                </div>
                <div class="mb-3">
                  <label for="nama" class="form-label">Favicon</label>
                  <br>
                  @if (isset($setting->favicon))
                    <img src="data:image/png;base64,{{ getStorage($setting->favicon) }}" alt="Favicon" class="img-thumbnail">
                  @endif
                </div>
              </div>
              <div class="col-lg-12 col-sm-12">
                <div class="text-end">
                  <button class="btn btn-primary">Update</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="tab-pane" id="sosial" role="tabpanel">
        <form action="{{  route('admin.setting.update', $setting->id)  }}" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="type" id="type" value="social">
          <div class="border p-4">
            <div class="mb-2">
              <label for="link_tiktok" class="form-label">Link Tiktok</label>
              <input type="text" name="link_tiktok" id="link_tiktok" class="form-control"
                value="{{ old('link_tiktok', $setting->link_tiktok) }}" placeholder="Link Tiktok">
              <x-input-error :messages="$errors->get('link_tiktok')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="link_instagram" class="form-label">Link Instagram</label>
              <input type="text" name="link_instagram" id="link_instagram" class="form-control"
                value="{{ old('link_instagram', $setting->link_instagram) }}" placeholder="Link Instagram">
              <x-input-error :messages="$errors->get('link_instagram')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="link_facebook" class="form-label">Link Facebook</label>
              <input type="text" name="link_facebook" id="link_facebook" class="form-control"
                value="{{ old('link_facebook', $setting->link_facebook) }}" placeholder="Link Facebook">
              <x-input-error :messages="$errors->get('link_facebook')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="link_twitter" class="form-label">Link Twitter / X</label>
              <input type="text" name="link_twitter" id="link_twitter" class="form-control"
                value="{{ old('link_twitter', $setting->link_twitter) }}" placeholder="Link Twitter/x">
              <x-input-error :messages="$errors->get('link_twitter')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="link_linkedin" class="form-label">Link Linked In</label>
              <input type="text" name="link_linkedin" id="link_linkedin" class="form-control"
                value="{{ old('link_linkedin', $setting->link_linkedin) }}" placeholder="Link LinkedIn">
              <x-input-error :messages="$errors->get('link_linkedin')" class="mt-2" />
            </div>
            <div class="text-end">
              <button class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
      <div class="tab-pane" id="mail_setting" role="tabpanel">
        <form action="{{ route('admin.setting.update', $setting->id)  }}" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" name="type" id="type" value="mail_setting">
          <div class="border p-4">
            <div class="mb-2">
              <label for="mail_mailer" class="form-label">Mail Mailer <i class="text-danger">*</i> </label>
              <input type="text" name="mail_mailer" id="mail_mailer" class="form-control"
                value="{{ old('mail_mailer', $setting->mail_mailer) }}" placeholder="Mail Mailer">
              <x-input-error :messages="$errors->get('mail_mailer')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="mail_host" class="form-label">Mail Host <i class="text-danger">*</i></label>
              <input type="text" name="mail_host" id="mail_host" class="form-control"
                value="{{ old('mail_host', $setting->mail_host) }}" placeholder="Mail Host">
              <x-input-error :messages="$errors->get('mail_host')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="mail_port" class="form-label">Mail Port <i class="text-danger">*</i></label>
              <input type="text" name="mail_port" id="mail_port" class="form-control"
                value="{{ old('mail_port', $setting->mail_port) }}" placeholder="Mail Port">
              <x-input-error :messages="$errors->get('mail_port')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="mail_username" class="form-label">Mail Username <i class="text-danger">*</i></label>
              <input type="text" name="mail_username" id="mail_username" class="form-control"
                value="{{ old('mail_username', $setting->mail_username) }}" placeholder="Mail Username">
              <x-input-error :messages="$errors->get('mail_username')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="mail_password" class="form-label">Mail Password/Token <i class="text-danger">*</i></label>
              <input type="text" name="mail_password" id="mail_password" class="form-control"
                value="{{ old('mail_password', $setting->mail_password) }}" placeholder="Mail Password/Token">
              <x-input-error :messages="$errors->get('mail_password')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="mail_encryption" class="form-label">Mail Encryption <i class="text-danger">*</i></label>
              <input type="text" name="mail_encryption" id="mail_encryption" class="form-control"
                value="{{ old('mail_encryption', $setting->mail_encryption) }}" placeholder="Mail Encryption">
              <x-input-error :messages="$errors->get('mail_encryption')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="mail_from_addres" class="form-label">Mail From Address <i class="text-danger">*</i></label>
              <input type="text" name="mail_from_addres" id="mail_from_addres" class="form-control"
                value="{{ old('mail_from_addres', $setting->mail_from_addres) }}" placeholder="Mail From Address">
              <x-input-error :messages="$errors->get('mail_from_addres')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="mail_from_name" class="form-label">Mail From Name <i class="text-danger">*</i></label>
              <input type="text" name="mail_from_name" id="mail_from_name" class="form-control"
                value="{{ old('mail_from_name', $setting->mail_from_name) }}" placeholder="Mail From Name">
              <x-input-error :messages="$errors->get('mail_from_name')" class="mt-2" />
            </div>
            <div class="text-end">
              <button class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
      <div class="tab-pane" id="warna" role="tabpanel">
        <form action="{{ route('admin.setting.update', $setting->id)  }}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <input type="hidden" name="type" id="type" value="warna">
            <div class="border p-4">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                  <div class="mb-2">
                    <label for="color_primary" class="form-label">Color Primary <i class="text-danger">*</i> </label>
                    <input type="color" name="color_primary" id="color_primary" class="form-control"
                      value="{{ old('color_primary', trim($setting->color_primary->primary_500, '"')) }}" placeholder="Color Primary">
                    <x-input-error :messages="$errors->get('color_primary')" class="mt-2" />
                  </div>

                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="mb-2">
                      <label for="color_secondary" class="form-label">Color Secondary <i class="text-danger">*</i> </label>
                      <input type="color" name="color_secondary" id="color_secondary" class="form-control"
                        value="{{ old('color_secondary', trim($setting->color_secondary->secondary_500, '"')) }}" placeholder="Color Primary">
                      <x-input-error :messages="$errors->get('color_secondary')" class="mt-2" />
                    </div>
                </div>
              </div>
              <div class="text-end">
                <button class="btn btn-primary">Update</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div><!-- end card-body -->
</div>
@endsection


@push('js')
@endpush