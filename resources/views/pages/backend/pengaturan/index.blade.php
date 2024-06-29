@extends('layouts.app')

@push('title')
Pengaturan
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
          Sosial Media
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#mail_setting" role="tab">
          Email
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="tab" href="#warna" role="tab">
          Warna Website
        </a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="general" role="tabpanel">
        <form action="{{ route('admin.pengaturan.update', $pengaturan->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="border p-4">
            <div class="mb-2">
              <label for="nama_website" class="form-label">Nama Website</label>
              <input type="text" name="nama" id="nama" class="form-control"
                value="{{ old('nama_website', $pengaturan->nama_website) }}" placeholder="Nama Website">
              <x-input-error :messages="$errors->get('nama_website')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="tagline" class="form-label">Tagline Website</label>
              <input type="text" name="tagline" id="tagline" class="form-control"
                value="{{ old('tagline', $pengaturan->tagline) }}" placeholder="Tagline Website">
              <x-input-error :messages="$errors->get('tagline')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="deskripsi" class="form-label">Deskripsi Website</label>
              <textarea name="deskripsi" id="deskripsi" cols="5" rows="5"
                class="form-control">{{ old('deskripsi', $pengaturan->deskripsi) }}</textarea>
              <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="email" class="form-label">Email Website</label>
              <input type="text" name="email" id="email" class="form-control"
                value="{{ old('email', $pengaturan->email) }}" placeholder="Email Website">
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="no_telp" class="form-label">No Telp Website</label>
              <input type="text" name="no_telp" id="no_telp" class="form-control"
                value="{{ old('no_telp', $pengaturan->no_telp) }}" placeholder="No Telp Website">
              <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
            </div>
            <div class="mb-2">
              <label for="alamat" class="form-label">Alamat Website</label>
              <textarea name="alamat" id="alamat" cols="5" rows="5"
                class="form-control">{{ old('alamat', $pengaturan->alamat) }}</textarea>
              <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
            </div>
            <div class="row">
                  <div class="col-lg-8 col-sm-12">
                    <div class="mb-2">
                      <label for="lokasi_maps" class="form-label">Link Maps Website</label>
                      <textarea name="lokasi_maps" id="lokasi_maps" class="form-control" cols="5" rows="7">{{ old('lokasi_maps', $pengaturan->lokasi_maps) }}</textarea>
                      <x-input-error :messages="$errors->get('lokasi_maps')" class="mt-2" />
                    </div>
                  </div>
                  <div class="col-lg-4 col-sm-12">
                    <div class="mb-2">
                      <label for="lokasi_maps" class="form-label">Priview</label>
                      <iframe src="{{ $pengaturan->lokasi_maps }}"  width="100%" height="50%" frameborder="0" style="border:1px solid #ccc;"></iframe>
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
        <div class="border p-4">
          <div class="row">
            <div class="col-lg-8 col-sm-8">
              <div class="mb-2">
                <label for="nama" class="form-label">Logo Main</label>
                <input type="file" name="logo_main" id="logo_main" class="form-control"
                  value="{{ old('logo_main', $pengaturan->logo_main) }}" placeholder="Logo Website Main">
                <x-input-error :messages="$errors->get('logo_main')" class="mt-2" />
              </div>
              <div class="mb-2">
                <label for="nama" class="form-label">Logo Kedua</label>
                <input type="file" name="logo_kedua" id="logo_kedua" class="form-control"
                  value="{{ old('logo_kedua', $pengaturan->logo_kedua) }}" placeholder="Logo Website Kedua">
                <x-input-error :messages="$errors->get('logo_kedua')" class="mt-2" />
              </div>
              <div class="mb-2">
                <label for="nama" class="form-label">Favicon</label>
                <input type="file" name="favicon" id="favicon" class="form-control"
                  value="{{ old('favicon', $pengaturan->favicon) }}" placeholder="Logo Favicon">
                <x-input-error :messages="$errors->get('favicon')" class="mt-2" />
              </div>
            </div>
            <div class="col-lg-4 col-sm-4">
              <div class="mb-3">
                <label for="nama" class="form-label">Logo Main</label>
                <img class="img-fluid" src="" alt="">
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Logo Kedua</label>
                <img class="img-fluid" src="" alt="">
              </div>
              <div class="mb-3">
                <label for="nama" class="form-label">Favicon</label>
                <img class="img-fluid" src="" alt="">
              </div>
            </div>
            <div class="col-lg-12 col-sm-12">
              <div class="text-end">
                <button class="btn btn-primary">Update</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="sosial" role="tabpanel">
        <div class="border p-4">
          <div class="mb-2">
            <label for="link_tiktok" class="form-label">Link Tiktok</label>
            <input type="text" name="link_tiktok" id="link_tiktok" class="form-control"
              value="{{ old('link_tiktok', $pengaturan->link_tiktok) }}" placeholder="Link Tiktok">
            <x-input-error :messages="$errors->get('link_tiktok')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="link_instagram" class="form-label">Link Instagram</label>
            <input type="text" name="link_instagram" id="link_instagram" class="form-control"
              value="{{ old('link_instagram', $pengaturan->link_instagram) }}" placeholder="Link Tiktok">
            <x-input-error :messages="$errors->get('link_instagram')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="link_facebook" class="form-label">Link Facebook</label>
            <input type="text" name="link_facebook" id="link_facebook" class="form-control"
              value="{{ old('link_facebook', $pengaturan->link_facebook) }}" placeholder="Link Tiktok">
            <x-input-error :messages="$errors->get('link_facebook')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="link_twitter" class="form-label">Link Twitter / X</label>
            <input type="text" name="link_twitter" id="link_twitter" class="form-control"
              value="{{ old('link_twitter', $pengaturan->link_twitter) }}" placeholder="Link Tiktok">
            <x-input-error :messages="$errors->get('link_twitter')" class="mt-2" />
          </div>
          <div class="text-end">
            <button class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="mail_setting" role="tabpanel">
        <div class="border p-4">
          <div class="mb-2">
            <label for="mail_mailer" class="form-label">Mail Mailer</label>
            <input type="text" name="mail_mailer" id="mail_mailer" class="form-control"
              value="{{ old('mail_mailer', $pengaturan->mail_mailer) }}" placeholder="Mail Mailer">
            <x-input-error :messages="$errors->get('mail_mailer')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="mail_host" class="form-label">Mail Host</label>
            <input type="text" name="mail_host" id="mail_host" class="form-control"
              value="{{ old('mail_host', $pengaturan->mail_host) }}" placeholder="Mail Host">
            <x-input-error :messages="$errors->get('mail_host')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="mail_port" class="form-label">Mail Port</label>
            <input type="text" name="mail_port" id="mail_port" class="form-control"
              value="{{ old('mail_port', $pengaturan->mail_port) }}" placeholder="Mail Port">
            <x-input-error :messages="$errors->get('mail_port')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="mail_username" class="form-label">Mail Username</label>
            <input type="text" name="mail_username" id="mail_username" class="form-control"
              value="{{ old('mail_username', $pengaturan->mail_username) }}" placeholder="Mail Username">
            <x-input-error :messages="$errors->get('mail_username')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="mail_password" class="form-label">Mail Password/Token</label>
            <input type="text" name="mail_password" id="mail_password" class="form-control"
              value="{{ old('mail_password', $pengaturan->mail_password) }}" placeholder="Mail Password/Token">
            <x-input-error :messages="$errors->get('mail_password')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="mail_encryption" class="form-label">Mail Encryption</label>
            <input type="text" name="mail_encryption" id="mail_encryption" class="form-control"
              value="{{ old('mail_encryption', $pengaturan->mail_encryption) }}" placeholder="Mail Encryption">
            <x-input-error :messages="$errors->get('mail_encryption')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="mail_from_addres" class="form-label">Mail From Address</label>
            <input type="text" name="mail_from_addres" id="mail_from_addres" class="form-control"
              value="{{ old('mail_from_addres', $pengaturan->mail_from_addres) }}" placeholder="Mail From Address">
            <x-input-error :messages="$errors->get('mail_from_addres')" class="mt-2" />
          </div>
          <div class="mb-2">
            <label for="mail_from_name" class="form-label">Mail From Name</label>
            <input type="text" name="mail_from_name" id="mail_from_name" class="form-control"
              value="{{ old('mail_from_name', $pengaturan->mail_from_name) }}" placeholder="Mail From Name">
            <x-input-error :messages="$errors->get('mail_from_name')" class="mt-2" />
          </div>
          <div class="text-end">
            <button class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="warna" role="tabpanel">
        <div class="border p-4">
          <div class="mb-2">
            <label for="mail_mailer" class="form-label">Mail Mailer</label>
            <input type="text" name="mail_mailer" id="mail_mailer" class="form-control"
              value="{{ old('mail_mailer', $pengaturan->mail_mailer) }}" placeholder="Mail Mailer">
            <x-input-error :messages="$errors->get('mail_mailer')" class="mt-2" />
          </div>
          <div class="text-end">
            <button class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
    </div>
  </div><!-- end card-body -->
</div>
@endsection


@push('js')
@endpush