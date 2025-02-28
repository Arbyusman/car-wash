<x-default-layout>
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">

                <div class="card-header flex-wrap border-0  pb-0">
                    <div class="card-title">
                        <h3 class="card-label">{{ $title }}
                            <span class="text-muted pt-2 font-size-sm d-block">{{ $description }}</span>
                        </h3>

                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('users.index') }}" class="btn btn-success font-weight-bold  me-5">
                            <i class="ki-duotone ki-arrows-loop fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Refresh
                        </a>


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#impor">
                            Import Users
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="impor" tabindex="-1" aria-labelledby="imporLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="imporLabel">Import Users</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <input type="file" name="file" required>
                                            <div class="mt-3">
                                                <span class="badge badge-danger">NOTE</span>
                                                <span>Ensure the file format is correct: <strong>("NIM",
                                                        "FULL NAME")</strong></span>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Import Users</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="table-responsive">
                    <table id="user" class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th style="width: 5%">NO</th>
                                <th style="width: 20%">Nama Lengkap</th>
                                <th style="width: 10%">NIM</th>
                                <th style="width: 20%">Email</th>
                                <th style="width: 20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp

                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->identification_number ?? 'N/A' }}</td>
                                    <td>{{ $item->email ?? 'N/A' }}</td>
                                    <td>
                                        {{-- <a href="{{ route('users.edit', ['id' => Crypt::encrypt($item->id)]) }}"
                                            title="Edit users" class="btn btn-icon btn-success">
                                            <i class="ki-duotone ki-user-edit fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </a> --}}
                                        <button title="Hapus User" type="button" class="btn btn-danger"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        @if (Auth::user()->role_id == 1)
                                            <button title="Reset Password" type="button" class="btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_reset{{ $item->id }}">
                                                <i class="ki-duotone ki-eraser fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </button>


                                            <div class="modal fade" id="kt_modal_reset{{ $item->id }}"
                                                tabindex="-1" aria-labelledby="modalTitle{{ $item->id }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form class="form-group modal-content p-5"
                                                        action="{{ route('users.resetPassword', ['id' => $item->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('post')
                                                        <div
                                                            class="row text-center justify-content-center align-items-center">
                                                            <h2 class="pt-10">Reset Password User</h2>
                                                            <span class="text-muted">Apakah Anda Yakin Untuk Reset
                                                                Password
                                                                pengguna

                                                                {{ $item->full_name }}
                                                            </span>
                                                        </div>
                                                        <input class="form-control col-6" type="hidden"
                                                            id="resetPassword"
                                                            value="{{ $item->identification_number ?? '12345678' }}"
                                                            name="resetPassword" placeholder="Reset password" />

                                                        <div class="pb-12 justify-content-center  d-flex">
                                                            <button type="button" class="m-2 btn btn-primary"
                                                                data-bs-dismiss="modal">Tidak</button>
                                                            <button type="submit"
                                                                class="m-2 btn btn-danger">YA</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="modal fade" id="kt_modal{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalTitle{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                                <form action="{{ route('users.delete') }}" method="POST"
                                                    class="modal-content">
                                                    @csrf
                                                    <input type="hidden" value="{{ Crypt::encrypt($item->id) }}"
                                                        name="id">
                                                    <div class="modal-body justify-content-center d-flex">
                                                        <div class="row col-12 pt-8">
                                                            <div
                                                                class="row text-center justify-content-center align-items-center">
                                                                <h2>Menghapus Data User</h2>
                                                                <span class="text-muted"> Setelah dihapus, data user
                                                                    tidak
                                                                    dapat di
                                                                    kembalikan, yakin ingin menghapus?</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pb-12 justify-content-center  d-flex">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger ms-2">YA</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <script>
        $("#user").DataTable({
            scrollY: true,
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: {
                left: 2
            }
        });
    </script>
</x-default-layout>
