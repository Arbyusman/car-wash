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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label>Nama Lengkap:</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Masukkan Nama Lengkap" />
                                        </div>
                                        <div class="mb-4">
                                            <label>NIM:</label>
                                            <input type="text" class="form-control" name="identification_number"
                                                placeholder="Masukkan NIM" />
                                        </div>
                                        <div class="">
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
                                        </div>

                                        <div class="my-2">
                                            <label>Role:</label>
                                            <div class="form-check form-check-custom form-check-solid">
                                                @foreach ($role as $itemRole)
                                                    @if ($fingerId && $itemRole->name === 'Admin' || $fingerId && $itemRole->name === 'Dosen'  )
                                                        @continue
                                                    @endif

                                                    <input class="form-check-input" style="margin-right:5px"
                                                        type="radio" value="{{ $itemRole->id }}"
                                                        id="role_{{ $itemRole->id }}" name="role" />
                                                    <label class="form-check-label" style="margin-right:5px"
                                                        for="role_{{ $itemRole->id }}">
                                                        {{ $itemRole->name }}
                                                    </label>
                                                @endforeach
                                            </div>

                                        </div>


                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-lg-6 ">
                                        <label>No HP:</label>
                                        <input type="phone" name="phone" class="form-control"
                                            placeholder="Masukkan No HP" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukkan Email" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Finger Print:</label>
                                        <input type="text" id="finger_print_id" name="finger_print_id"
                                            class="form-control" placeholder="Masukkan Finger Print"
                                            value="{{ $fingerId ?? 0 }}" readonly />
                                    </div>

                                </div>

                                @if (!$fingerId)
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Password:</label>
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Masukkan Password" />
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Konfirmasi Password:</label>
                                            <input type="password" class="form-control" id="confirmPassword"
                                                name="password" placeholder="Masukkan Konfirmasi Password" />
                                            <p id="passwordMatchMessage" style="color: red;"></p>
                                        </div>
                                    </div>
                                @endif


                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const passwordMatchMessage = document.getElementById('passwordMatchMessage');

        confirmPasswordInput.addEventListener('input', () => {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (password === confirmPassword) {
                passwordMatchMessage.textContent = 'Password cocok.';
                passwordMatchMessage.style.color = 'green';
            } else {
                passwordMatchMessage.textContent = 'Password tidak cocok.';
                passwordMatchMessage.style.color = 'red';
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ambil-data').on('click', function() {
                $.ajax({
                    url: '{{ route('fingerprint.add') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log("data", data)
                        if (data.status === 'success') {
                            $('#finger_print_id').val(data.data);
                        } else {
                            alert('Error: ' + data.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                        alert('Failed to fetch fingerprint data.');
                    }
                });
            });
        });
    </script>
</x-default-layout>
