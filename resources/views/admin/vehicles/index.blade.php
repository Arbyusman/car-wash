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
                        <a title="Refresh" href="{{ route('vehicles.index') }}"
                            class="btn btn-success font-weight-bold me-2">
                            <i class="ki-duotone ki-arrows-loop fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Refresh
                        </a>
                        <a title="Tambah Kendaraan" type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#add-vehicle">
                            <i class="ki-duotone ki-plus fs-1 ">
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
                                <th style="width: 20%">Biaya</th>
                                <th style="width: 20%">Upah Pencuci</th>
                                <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = 1;
                            @endphp

                            @if ($vehicles->isEmpty())
                                <x-no-data-row colspan="4" message="Data tidak ditemukan" />
                            @else
                                @foreach ($vehicles as $vehicle)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $vehicle->name ?? 'N/A' }}</td>
                                        <td>{{ $vehicle->vehicleType->size ?? 'N/A' }}</td>
                                        <td>{{ toRupiah($vehicle->cost) ?? 'N/A' }}</td>
                                        <td>{{ toRupiah($vehicle->washer_cost) ?? 'N/A' }}</td>
                                        <td>
                                            <button title="Ubah Kendaraan" type="button"
                                                class="btn btn-icon btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#update-vehicle{{ $vehicle->id }}">
                                                <i class="fas far fa-edit"></i>
                                            </button>

                                            <x-modal id="update-vehicle{{ $vehicle->id }}" class="mw-650px">
                                                <x-slot name="title">Ubah Data Kendaraan</x-slot>
                                                <x-slot name="body">
                                                    <form action="{{ route('vehicles.update', ['vehicle' => $vehicle]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="fv-row mb-4">
                                                            <x-label class="mb-2 fs-6 fw-semibold"
                                                                value="Nama Kendaraan" />
                                                            <x-input type="text" id="edit_name" name="name"
                                                                value="{{ $vehicle->name }}"
                                                                placeholder="Nama Kendaraan" />

                                                        </div>

                                                        <div class="fv-row my-4">
                                                            <x-label class="mb-2 fs-6 fw-semibold"
                                                                value="Tipe Kendaraan" />
                                                            <select class="form-select" name="vehicle_type_id" required>
                                                                <option value="" readonly>Pilih Tipe Kendaraan
                                                                </option>
                                                                @foreach ($vehicleTypes as $vehicleType)
                                                                    <option value="{{ $vehicleType->id }}"
                                                                        {{ $vehicle->vehicle_type_id == $vehicleType->id ? 'selected' : '' }}
                                                                        >
                                                                        {{ $vehicleType->size }} -
                                                                        {{ $vehicleType->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-4">
                                                            <x-label class="mb-2 fs-6 fw-semibold" value="Biaya" />
                                                            <x-input class="idr-currency" type="text" id="edit_cost"
                                                                name="cost" value="{{ $vehicle->cost }}"
                                                                placeholder="Biaya" />

                                                        </div>

                                                        <div class="fv-row mb-4">
                                                            <x-label class="mb-2 fs-6 fw-semibold"
                                                                value="Upah Pencuci" />
                                                            <x-input class="idr-currency" type="text"
                                                                id="edit_washer_cost" name="washer_cost"
                                                                value="{{ $vehicle->washer_cost }}"
                                                                placeholder="Upah Pencuci" />

                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center gap-2">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>

                                                    </form>
                                                </x-slot>
                                            </x-modal>


                                            <button title="Hapus Kendaraan" type="button"
                                                class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete-vehicle{{ $vehicle->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <div class="modal fade" id="delete-vehicle{{ $vehicle->id }}"
                                                tabindex="-1" role="dialog"
                                                aria-labelledby="modalTitle{{ $vehicle->id }}" aria-hidden="true">
                                                <div class="modal-dialog " role="document">
                                                    <form
                                                        action="{{ route('vehicles.destroy', ['vehicle' => $vehicle]) }}"
                                                        method="POST" class="modal-content">
                                                        @csrf
                                                        @method('delete')
                                                        <div class="modal-body justify-content-center d-flex">
                                                            <div class="row col-12 pt-8">
                                                                <div
                                                                    class="row text-center justify-content-center align-items-center">
                                                                    <h2>Menghapus Data Kendaraan</h2>
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

                    {{ $vehicles->links() }}

                </div>

                <x-modal id="add-vehicle" class="mw-650px">
                    <x-slot name="title">Tambah Data Kendaraan</x-slot>
                    <x-slot name="body">
                        <form action="{{ route('vehicles.store') }}" method="POST">
                            @csrf
                            <div class="fv-row mb-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Nama Kendaraan" />
                                <x-input type="text" id="name" name="name"
                                    placeholder="Nama Kendaraan" />

                            </div>

                            <div class="fv-row my-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Tipe Kendaraan" />
                                <select class="form-select" name="vehicle_type_id" required>
                                    <option value="" readonly>Pilih Tipe Kendaraan</option>
                                    @foreach ($vehicleTypes as $vehicleType)
                                        <option value="{{ $vehicleType->id }}">
                                            {{ $vehicleType->size }} -
                                            {{ $vehicleType->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="fv-row mb-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Biaya" />
                                <x-input class="idr-currency" type="text" id="cost" name="cost"
                                    placeholder="Biaya" />

                            </div>

                            <div class="fv-row mb-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Upah Pencuci" />
                                <x-input class="idr-currency" type="text" id="washer_cost" name="washer_cost"
                                    placeholder="Upah Pencuci" />

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

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
        <script src="{{ asset('assets/js/custom/apps/vehicles/index.js') }}"></script>
    @endpush

</x-default-layout>
