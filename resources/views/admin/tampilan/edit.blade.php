
<x-default-layout>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="col-lg-6 mt-2 p-2 text-right d-flex justify-content-end">
                                <a href="{{ url('dashboard') }}" class="btn btn-light-primary font-weight-bolder me-2">
                                    <i class="ki-duotone ki-double-left fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Kembali</a>
                            </div>
                        </div>

                        <form class="form"
                            action="{{ route('settings.update', ['id' => Crypt::encrypt($setting->id)]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- @method('put') --}}
                            <input type="hidden" name="id" value="{{ $setting->id }}">
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <label>Nama Aplikasi:</label>
                                            <input value="{{ $setting->name }}" type="text"
                                                class="form-control" name="name"
                                                placeholder="Masukkan Nama Aplikasi" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <label>Nama Singkatan Aplikasi:</label>
                                            <input value="{{ $setting->short_name }}" type="text"
                                                class="form-control" name="short_name"
                                                placeholder="Masukkan Nama Singkatan Aplikasi" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <label>URL Absen:</label>
                                            <input value="{{ $setting->base_url_absens }}" type="text"
                                                class="form-control" name="base_url_absens"
                                                placeholder="Masukkan URL absen Aplikasi" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <label>Logo Kecil Aplikasi:</label>
                                            <div class="mt-5 col-12">
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting->small_icon) ?? 'assets/media/svg/files/blank-image.svg' }});
                                                    }
                                                    [data-bs-theme="dark"] .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting->small_icon) ?? 'assets/media/svg/files/blank-image.svg' }});
                                                    }
                                                </style>
                                                <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-150px h-150px"
                                                        style="background-image: url({{ asset('storage/images/' . $setting->small_icon) ?? 'assets/media/svg/files/blank-image.svg' }}"></div>
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change small_icon">
                                                        <i class="ki-duotone ki-pencil fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <input type="file" name="small_icon"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                    </label>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <label>Logo Besar Aplikasi:</label>
                                            <div class="mt-5 col-12">
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting->large_icon) ?? 'assets/media/svg/files/blank-image.svg' }});
                                                    }
                                                    [data-bs-theme="dark"] .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting->large_icon) ?? 'assets/media/svg/files/blank-image.svg' }});
                                                    }
                                                </style>
                                                <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-150px h-150px"
                                                        style="background-image: url({{ asset('storage/images/' . $setting->large_icon) ?? 'assets/media/svg/files/blank-image.svg' }}"></div>
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change large_icon">
                                                        <i class="ki-duotone ki-pencil fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <input type="file" name="large_icon"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                    </label>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <label>Background Login:</label>
                                            <div class="mt-5 col-12">
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting->background_login) ?? 'assets/media/svg/files/blank-image.svg' }});
                                                    }
                                                    [data-bs-theme="dark"] .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting->background_login) ?? 'assets/media/svg/files/blank-image.svg' }});
                                                    }
                                                </style>
                                                <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-150px h-150px"
                                                        style="background-image: url({{ asset('storage/images/' . $setting->background_login) ?? 'assets/media/svg/files/blank-image.svg' }}"></div>
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change background_login">
                                                        <i class="ki-duotone ki-pencil fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <input type="file" name="background_login"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                    </label>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="ki-duotone ki-cross fs-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6 mt-5">
                                            <button type="submit" id="kt_notify_btn"
                                                class="btn btn-primary me-2">Simpan</button>
                                            <button type="reset" class="btn btn-secondary">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input, imageId, defaultImageUrl) {
            var imageWrapper = document.getElementById(imageId);
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imageWrapper.style.backgroundImage = 'url(' + URL.createObjectURL(input.files[0]) + ')';
                };
                reader.readAsDataURL(input.files[0]);
            } else if (defaultImageUrl) {
                imageWrapper.style.backgroundImage = 'url(' + defaultImageUrl + ')';
            }
        }
    </script>


</x-default-layout>
