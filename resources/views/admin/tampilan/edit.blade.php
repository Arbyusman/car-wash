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
                            action="{{ route('settings.update', ['id' => Crypt::encrypt($setting?->id)]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <x-input type="hidden" name="id" value="{{ $setting?->id }}" />
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <x-label value="Nama Aplikasi" />
                                            <x-input value="{{ $setting?->name }}" type="text" class="form-control"
                                                name="name" placeholder="Masukkan Nama Aplikasi" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <x-label value="Nama Singkatan Aplikasi" />
                                            <x-input value="{{ $setting?->short_name }}" type="text"
                                                class="form-control" name="short_name"
                                                placeholder="Masukkan Nama Singkatan Aplikasi" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 mt-5">
                                        <x-label class="mb-2 fs-6 fw-semibold" value="Phone" />
                                        <x-input class="phone" type="text" id="phone{{ $setting?->id }}"
                                            name="phone" placeholder="Phone"
                                            value="{{ str_replace(['+62', ' '], '', $setting?->phone) }}" />
                                    </div>

                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <x-label value="Email" />
                                            <x-input value="{{ $setting?->email }}" type="email" class="form-control"
                                                name="email" placeholder="Masukkan Email" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <x-label value="Jam Operasional" />
                                            <x-input value="{{ $setting?->opening_hour }}" type="Jam Operasional"
                                                class="form-control" name="opening_hour"
                                                placeholder="Masukkan Jam Operasional" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <x-label value="Alamat" />
                                            <textarea rows="3" type="text" class="form-control" name="address" placeholder="Masukkan Alamat">
                                                {{ $setting?->address }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="">
                                        <x-label value="Map" />
                                        <textarea rows="5" type="text" class="form-control" name="address" placeholder="Masukkan Embed Map">
                                                {{ $setting?->embed_map }}
                                            </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6 mt-5">
                                        <div class="">
                                            <x-label value="Logo Kecil Aplikasi" />
                                            <div class="mt-5 col-12">
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting?->small_icon) }});
                                                    }

                                                    [data-bs-theme="dark"] .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting?->small_icon) }});
                                                    }
                                                </style>
                                                <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-150px h-150px"
                                                        style="background-image: url('{{ asset('storage/images/' . $setting?->small_icon) }}');">
                                                    </div>
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change small_icon">
                                                        <i class="ki-duotone ki-pencil fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <x-input type="file" name="small_icon"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <x-input type="hidden" name="avatar_remove" />
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
                                            <x-label value="Besar Aplikasi" />
                                            <div class="mt-5 col-12">
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting?->large_icon) }});
                                                    }

                                                    [data-bs-theme="dark"] .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting?->large_icon) }});
                                                    }
                                                </style>
                                                <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-150px h-150px"
                                                        style="background-image: url('{{ asset('storage/images/' . $setting?->large_icon) }}');">
                                                    </div>
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change large_icon">
                                                        <i class="ki-duotone ki-pencil fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <x-input type="file" name="large_icon"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <x-input type="hidden" name="avatar_remove" />
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
                                            <x-label value="Login" />
                                            <div class="mt-5 col-12">
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting?->background_login) }});
                                                    }

                                                    [data-bs-theme="dark"] .image-input-placeholder {
                                                        background-image: url({{ asset('storage/images/' . $setting?->background_login) }});
                                                    }
                                                </style>
                                                <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-150px h-150px"
                                                        style="background-image: url('{{ asset('storage/images/' . $setting?->background_login) }}');">

                                                    </div>
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change background_login">
                                                        <i class="ki-duotone ki-pencil fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <x-input type="file" name="background_login"
                                                            accept=".png, .jpg, .jpeg" />
                                                        <x-input type="hidden" name="avatar_remove" />
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

    @push('scripts')
        <script>
            Inputmask({
                mask: "+62 999 9999 9999",
                showMaskOnHover: false,
                showMaskOnFocus: false,
                placeholder: " ",
                autoUnmask: true
            }).mask("input[name=phone]");

            Inputmask({
                mask: "aaa - aaa, 99:99 - 99:99",
                definitions: {
                    "a": {
                        validator: "[A-Za-z]",
                        casing: "upper"
                    }
                },
                showMaskOnHover: false,
                showMaskOnFocus: false,
                placeholder: " ",
                autoUnmask: true
            }).mask("input[name=opening_hour]");
        </script>
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
    @endpush
</x-default-layout>
