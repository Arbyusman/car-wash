<x-default-layout>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="col-lg-6 mt-2 p-2 text-right d-flex justify-content-end">
                                <a href="{{ route('users.index') }}"
                                    class="btn btn-light-primary font-weight-bolder me-2">
                                    <i class="ki-duotone ki-double-left fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Kembali</a>
                            </div>
                        </div>

                        <form class="form" action="{{ route('users.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6 align-items-center justify-content-center d-flex">
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="mt-1">
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url('assets/media/svg/files/blank-image.svg');
                                                    }

                                                    [data-bs-theme="dark"] .image-input-placeholder {
                                                        background-image: url('assets/media/svg/files/blank-image.svg');
                                                    }
                                                </style>
                                                <div class="image-input image-input-outline image-input-placeholder image-input-empty image-input-empty"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-200px h-200px"
                                                        style="background-image: url('')"></div>
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change avatar">
                                                        <i class="ki-duotone ki-pencil fs-7">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <input type="file" name="avatar"
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
                                                @error('avatar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="my-4">
                                            <label>Nama Lengkap:</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Masukkan Nama Lengkap" />
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="my-4">
                                            <label>Jenis Kelamin:</label>
                                            <select type="" class="form-control" name="jenis_kelamin"
                                                placeholder="Masukkan Jenis Kelamin">
                                                <option value="Laki-laki">
                                                    Laki-laki
                                                </option>
                                                <option value="Perempuan">
                                                    Perempuan
                                                </option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="my-4">
                                            <label>Role:</label>
                                            <div class="form-check form-check-custom form-check-solid">
                                                @foreach ($role as $itemRole)
                                                    <input class="form-check-input" style="margin-right:5px"
                                                        type="radio" value="{{ $itemRole->id }}"
                                                        id="role_{{ $itemRole->id }}" name="role" />
                                                    <label class="form-check-label" style="margin-right:5px"
                                                        for="role_{{ $itemRole->id }}">
                                                        {{ $itemRole->name }}
                                                    </label>
                                                @endforeach
                                            </div>
                                            @error('role_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="my-4">
                                            <label>No HP:</label>
                                            <input type="phone" name="phone" class="form-control"
                                                placeholder="Masukkan No HP" />
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="my-4">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Masukkan Email" />
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="my-4">
                                            <label>Password:</label>
                                            <input id="password" type="password" name="password" class="form-control"
                                                placeholder="Masukkan  Password" />
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="my-4">
                                            <label>Konfirmasi Password:</label>
                                            <input id="confirmPassword" type="password" name="password_confirmation"
                                                class="form-control" placeholder="Masukkan Konfirmasi Password" />
                                            @error('confirm_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="row justify-content-end">
                                        <div class="col-lg-6 justify-content-end">
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
            const imageInput = document.querySelector('.image-input-wrapper');
            const fileInput = document.querySelector('input[name="avatar"]');

            fileInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        imageInput.style.backgroundImage = `url('${e.target.result}')`;
                    };
                    reader.readAsDataURL(file);
                } else {
                    imageInput.style.backgroundImage =
                        `url('{{ Auth::user()->foto ? asset('image/foto/' . Auth::user()->foto) : asset('media/users/blank.png') }}')`;
                }
            });
        </script>
    @endpush

</x-default-layout>
