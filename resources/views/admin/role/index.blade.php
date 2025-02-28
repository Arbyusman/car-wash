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
                        <a title="Refresh" href="{{ route('roles.index') }}"
                            class="btn btn-success font-weight-bold me-5">
                            <i class="ki-duotone ki-arrows-loop fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Refresh
                        </a>
                        <a title="Tambah Role user"
                            href="{{ route('roles.create') }}"
                            class="btn btn-primary font-weight-bolder">
                            <i class="ki-duotone ki-plus fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Tambah
                        </a>

                    </div>

                </div>
                <div class="table-responsive">
                    <table id="sub-menu" class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th style="width: 5%">NO</th>
                                <th style="width: 20%">Nama Role</th>
                                <th style="width: 10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = 1;
                            @endphp
                            @foreach ($role as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->name ?? 'N/A' }}</td>
                                  
                                    <td>

                                        <a href="{{ route('roles.edit', ['id' => Crypt::encrypt($item->id)]) }}"
                                            title="Edit Role User" class="btn btn-icon btn-success">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button title="Hapus Role" type="button" class="btn btn-icon btn-danger"
                                            data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>



                                        <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modalTitle{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog " role="document">
                                                <form
                                                    action="{{ route('roles.delete', ['role_id' => Crypt::encrypt($item->id), 'id' => Crypt::encrypt($item->id)]) }}"
                                                    method="POST" class="modal-content">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" value="{{ Crypt::encrypt($item->id) }}"
                                                        name="id">
                                                    <div class="modal-body justify-content-center d-flex">
                                                        <div class="row col-12 pt-8">
                                                            <div
                                                                class="row text-center justify-content-center align-items-center">
                                                                <h2>Menghapus Data Role</h2>
                                                                <span class="text-muted"> Setelah dihapus, data Role
                                                                    tidak
                                                                    dapat di
                                                                    kembalikan, yakin ingin menghapus?</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pb-12 justify-content-center  d-flex">
                                                        <button type="button" class="m-2 btn btn-primary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="m-2 btn btn-danger">YA</button>
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
        $("#sub-menu").DataTable({
            scrollY: true,
            scrollX: true,
            scrollCollapse: true,
            fixedColumns: {
                left: 2
            }
        });
    </script>
</x-default-layout>
