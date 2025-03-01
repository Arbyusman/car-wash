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
                        <a title="Refresh" href="{{ route('vehicle-types.index') }}"
                            class="btn btn-success font-weight-bold me-2">
                            <i class="ki-duotone ki-arrows-loop fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Refresh
                        </a>
                        <a title="Tambah Tipe Kendaraan" type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#add-vehicle-type">
                            <i class="ki-duotone ki-plus fs-1                    ">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            Tambah
                        </a>

                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th style="width: 5%">NO</th>
                                <th style="width: 20%">Nama</th>
                                <th style="width: 20%">Ukuran</th>
                                <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = 1;
                            @endphp

                            @if ($vehicleTypes->isEmpty())
                                <x-no-data-row colspan="4" message="Data tidak ditemukan" />
                            @else
                                @foreach ($vehicleTypes as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name ?? 'N/A' }}</td>
                                        <td>{{ $item->size ?? 'N/A' }}</td>
                                        <td>
                                            <button title="Ubah Tipe Kendaraan" type="button"
                                                class="btn btn-icon btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#update-vehicle-type{{ $item->id }}">
                                                <i class="fas far fa-edit"></i>
                                            </button>

                                            <x-modal id="update-vehicle-type{{ $item->id }}" class="mw-650px">
                                                <x-slot name="title">Ubah Data Tipe Kendaraan</x-slot>
                                                <x-slot name="body">
                                                    <form action="{{ route('vehicle-types.update',['vehicle_type' =>  $item ]) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="fv-row my-2">
                                                            <x-label class="mb-2 fs-6 fw-semibold"
                                                                value="Nama Tipe Kendaraan" />
                                                            <x-input type="text" id="name" name="name"
                                                                value="{{ $item->name }}"
                                                                placeholder="Nama Tipe Kendaraan" />

                                                        </div>

                                                        <div class="fv-row my-2">
                                                            <x-label class="mb-2 fs-6 fw-semibold"
                                                                value="Ukuran Kendaraan" />
                                                            <select class="form-select" name="size" required>
                                                                <option value="" readonly>Pilih Ukuran Kendaraan
                                                                </option>
                                                                @foreach (sizeTypes() as $sizeType)
                                                                    <option value="{{ $sizeType }}"
                                                                        {{ $item->size == $sizeType ? 'selected' : '' }}>
                                                                        {{ $sizeType }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="modal-footer d-flex justify-content-center gap-2">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </x-slot>
                                            </x-modal>


                                            <button title="Hapus Tipe Kendaraan" type="button"
                                                class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete-vehicle-type{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <div class="modal fade" id="delete-vehicle-type{{ $item->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="modalTitle{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog " role="document">
                                                    <form
                                                        action="{{ route('vehicle-types.destroy', ['vehicle_type' =>  $item ]) }}"
                                                        method="POST" class="modal-content">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-body justify-content-center d-flex">
                                                            <div class="row col-12 pt-8">
                                                                <div
                                                                    class="row text-center justify-content-center align-items-center">
                                                                    <h2>Menghapus Data Tipe Kendaraan</h2>
                                                                    <span class="text-muted"> Setelah dihapus, data Tipe
                                                                        Kendaraan
                                                                        tidak
                                                                        dapat di
                                                                        kembalikan, yakin ingin menghapus?</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="pb-12 justify-content-center  d-flex">
                                                            <button type="button" class="m-2 btn btn-primary"
                                                                data-bs-dismiss="modal">Tidak</button>
                                                            <button type="submit"
                                                                class="m-2 btn btn-danger">YA</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>


                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                    {{ $vehicleTypes->links() }}

                </div>

                <x-modal id="add-vehicle-type" class="mw-650px">
                    <x-slot name="title">Tambah Data Tipe Kendaraan</x-slot>
                    <x-slot name="body">
                        <form action="{{ route('vehicle-types.store') }}" method="POST">
                            @csrf
                            <div class="fv-row my-2">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Nama Tipe Kendaraan" />
                                <x-input type="text" id="name" name="name"
                                    placeholder="Nama Tipe Kendaraan" />

                            </div>

                            <div class="fv-row my-2">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Ukuran Kendaraan" />
                                <select class="form-select" name="size" required>
                                    <option value="" readonly>Pilih Ukuran Kendaraan</option>
                                    @foreach (sizeTypes() as $sizeType)
                                        <option value="{{ $sizeType }}">{{ $sizeType }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="modal-footer d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </x-slot>
                </x-modal>
            </div>
        </div>
    </div>
</x-default-layout>
