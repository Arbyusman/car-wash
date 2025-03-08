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
                        <a title="Refresh" href="{{ route('wash-transactions.index') }}"
                            class="btn btn-success font-weight-bold me-2">
                            <i class="ki-duotone ki-arrows-loop fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Refresh
                        </a>
                        <a title="Tambah Transaksi" type="button" class="btn btn-primary" data-bs-toggle="modal"
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
                                <th style="width: 2%">No</th>
                                <th style="width: 10%">No Transaksi</th>
                                <th style="width: 10%">Pekerja</th>
                                <th style="width: 10%">Tanggal</th>
                                <th style="width: 10%">Biaya</th>
                                <th style="width: 10%">Biaya Tambahan</th>
                                <th style="width: 10%">Total</th>
                                <th style="width: 10%">Total Bayar</th>
                                <th style="width: 10%">Total Kembalian</th>
                                <th style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = 1;
                            @endphp

                            @if ($washTransactions->isEmpty())
                                <x-no-data-row colspan="10" message="Data tidak ditemukan" />
                            @else
                                @foreach ($washTransactions as $washTransaction)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $washTransaction->transaction_number ?? 'N/A' }}</td>
                                        <td>{{ $washTransaction->washer->name ?? 'N/A' }}</td>
                                        <td>{{ $washTransaction->created_at ? \Carbon\Carbon::parse($washTransaction->created_at)->locale('id')->translatedFormat('l, d F Y H:i') . ' WITA' : 'N/A' }}
                                        </td>

                                        <td>{{ toRupiah($washTransaction->washTransactionDetail?->vehicle?->cost ?? 0) }}
                                        </td>
                                        <td>{{ toRupiah($washTransaction->washTransactionDetail->additional_cost ?? 0) }}
                                        </td>
                                        <td>{{ toRupiah($washTransaction->total_cost ?? 0) }}</td>
                                        <td>{{ toRupiah($washTransaction->payment_amount ?? 0) }}</td>
                                        <td>{{ toRupiah($washTransaction->change_amount ?? 0) }}</td>
                                        <td>
                                            <a href="" title="Print Nota" class="btn btn-icon btn-secondary">
                                                <i class="fas far fa-file-alt"></i>
                                            </a>
                                            @if (!$washTransaction->is_printed)
                                                <button title="Ubah Transaksi" type="button"
                                                    class="btn btn-icon btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#update-wash-transaction{{ $washTransaction->id }}">
                                                    <i class="fas far fa-edit"></i>
                                                </button>

                                                <x-modal id="update-wash-transaction{{ $washTransaction->id }}"
                                                    class="mw-650px">
                                                    <x-slot name="title">Ubah Data Transaksi</x-slot>
                                                    <x-slot name="body">
                                                        <form
                                                            action="{{ route('wash-transactions.update', ['wash_transaction' => $washTransaction]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="fv-row my-4">
                                                                <x-label class="mb-2 fs-6 fw-semibold"
                                                                    value="Kendaraan" />
                                                                <select class="form-select" data-control="select2"
                                                                    data-dropdown-parent="#update-wash-transaction{{ $washTransaction->id }}"
                                                                    name="vehicle_id"
                                                                    id="edit_vehicle_id"
                                                                    required>
                                                                    <option value="" readonly>Pilih Kendaraan
                                                                    </option>
                                                                    @foreach ($vehicles as $vehicle)
                                                                        <option value="{{ $vehicle->id }}"
                                                                            data-cost="{{ $vehicle->cost }}"
                                                                            {{ $vehicle->id == $washTransaction->washTransactionDetail->vehicle_id ? 'selected' : '' }}>
                                                                            {{ $vehicle->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>


                                                            <div class="fv-row my-4">
                                                                <x-label class="mb-2 fs-6 fw-semibold"
                                                                    value="Pekerja" />
                                                                <select class="form-select" data-control="select2"
                                                                    data-dropdown-parent="#update-wash-transaction{{ $washTransaction->id }}"
                                                                    name="washer_id" id="edit_washer_id" required>
                                                                    <option value="" readonly>Pilih Pekerja
                                                                    </option>
                                                                    @foreach ($washers as $washer)
                                                                        <option value="{{ $washer->id }}"
                                                                            {{ $washer->id == $washTransaction->washer_id ? 'selected' : '' }}>
                                                                            {{ $washer->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                            <div class="fv-row mb-4">
                                                                <x-label class="mb-2 fs-6 fw-semibold"
                                                                    value="Nomor Plat Kendaraan" />
                                                                <x-input class="plate-number" type="text"
                                                                    id="edit_plate_number" name="plate_number"
                                                                    value="{{ $washTransaction->washTransactionDetail->plate_number ?? '' }}"
                                                                    placeholder="Nomor Plat Kendaraan" />
                                                            </div>


                                                            <div class="fv-row mb-4">
                                                                <x-label class="mb-2 fs-6 fw-semibold" value="Biaya" />
                                                                <x-input class="idr-currency" type="text"
                                                                    id="edit_cost" name="cost" value="{{ $washTransaction->washTransactionDetail->vehicle->cost ?? '' }}"

                                                                    placeholder="Biaya" readonly />
                                                            </div>


                                                            <div class="fv-row mb-4">
                                                                <x-label class="mb-2 fs-6 fw-semibold"
                                                                    value="Biaya Tambahan" />
                                                                <div class="position-relative w-md-300px"
                                                                    data-kt-dialer="true" id=""
                                                                    data-kt-dialer-min="0" data-kt-dialer-max="100000"
                                                                    data-kt-dialer-step="10000"
                                                                    data-kt-dialer-prefix="Rp"
                                                                    data-kt-dialer-currency="true">

                                                                    <button type="button"
                                                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                                                        data-kt-dialer-control="decrease">
                                                                        <i class="ki-duotone ki-minus-square fs-2"><span
                                                                                class="path1"></span><span
                                                                                class="path2"></span></i>
                                                                    </button>

                                                                    <input type="text"
                                                                        class="form-control form-control-solid border-0 ps-12"
                                                                        data-kt-dialer-control="input"
                                                                        placeholder="Amount" name="additional_cost"
                                                                        id="edit_additional_cost" readonly
                                                                        value="{{ $washTransaction->washTransactionDetail->additional_cost ?? '' }}"
                                                                        value="" />

                                                                    <button type="button"
                                                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                                                        data-kt-dialer-control="increase">
                                                                        <i class="ki-duotone ki-plus-square fs-2"><span
                                                                                class="path1"></span><span
                                                                                class="path2"></span><span
                                                                                class="path3"></span></i>
                                                                    </button>
                                                                </div>

                                                            </div>

                                                            <div class="fv-row mb-4">
                                                                <x-label class="mb-2 fs-6 fw-semibold"
                                                                    value="Total" />
                                                                <x-input class="idr-currency" type="text"
                                                                    id="edit_total_cost" name="total_cost"
                                                                    value="{{ $washTransaction->total_cost ?? '' }}"
                                                                     placeholder="Total " readonly />
                                                            </div>

                                                            <div class="fv-row mb-4">
                                                                <x-label class="mb-2 fs-6 fw-semibold"
                                                                    value="Jumlah Bayar" />
                                                                <x-input class="idr-currency" type="text"
                                                                    id="edit_payment_amount" name="payment_amount"
                                                                    value="{{ $washTransaction->payment_amount ?? '' }}"
                                                                     placeholder="Total Bayar" />
                                                            </div>

                                                            <div class="fv-row mb-4">
                                                                <x-label class="mb-2 fs-6 fw-semibold"
                                                                    value="Jumlah Kembalian" />
                                                                <x-input class="idr-currency" type="text"
                                                                    id="edit_change_amount" name="change_amount"
                                                                    value="{{ $washTransaction->change_amount ?? '' }}"
                                                                     placeholder="Jumlah Kembalian"
                                                                    readonly />
                                                            </div>


                                                            <div
                                                                class="modal-footer d-flex justify-content-center gap-2">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>

                                                        </form>
                                                    </x-slot>
                                                </x-modal>


                                                <button title="Hapus Transaksi" type="button"
                                                    class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delete-wash-transaction{{ $washTransaction->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>

                                                <div class="modal fade"
                                                    id="delete-wash-transaction{{ $washTransaction->id }}"
                                                    tabindex="-1" role="dialog"
                                                    aria-labelledby="modalTitle{{ $washTransaction->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog " role="document">
                                                        <form
                                                            action="{{ route('wash-transactions.destroy', ['wash_transaction' => $washTransaction]) }}"
                                                            method="POST" class="modal-content">
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-body justify-content-center d-flex">
                                                                <div class="row col-12 pt-8">
                                                                    <div
                                                                        class="row text-center justify-content-center align-items-center">
                                                                        <h2>Menghapus Data Transaksi {{ $washTransaction->transaction_number }}</h2>
                                                                        <span class="text-muted"> Setelah dihapus, data
                                                                            Transaksi
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

                                            @endif




                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                    {{ $washTransactions->links() }}
                </div>

                <x-modal id="add-vehicle" class="mw-650px">
                    <x-slot name="title">Tambah Data Transaksi</x-slot>
                    <x-slot name="body">
                        <form action="{{ route('wash-transactions.store') }}" method="POST">
                            @csrf
                            <div class="fv-row my-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Kendaraan" />
                                <select class="form-select" data-control="select2"
                                    data-dropdown-parent="#add-vehicle" name="vehicle_id" id="vehicle_id" required>
                                    <option value="" readonly>Pilih Kendaraan</option>
                                    @foreach ($vehicles as $vehicle)
                                        <option value="{{ $vehicle->id }}" data-cost="{{ $vehicle->cost }}">
                                            {{ $vehicle->name }}</option>
                                    @endforeach
                                </select>

                            </div>


                            <div class="fv-row my-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Pekerja" />
                                <select class="form-select" data-control="select2"
                                    data-dropdown-parent="#add-vehicle" name="washer_id" required>
                                    <option value="" readonly>Pilih Pekerja</option>
                                    @foreach ($washers as $washer)
                                        <option value="{{ $washer->id }}">
                                            {{ $washer->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="fv-row mb-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Nomor Plat Kendaraan" />
                                <x-input class="plate-number" type="text" id="plate_number" name="plate_number"
                                    placeholder="Nomor Plat Kendaraan" />
                            </div>


                            <div class="fv-row mb-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Biaya" />
                                <x-input class="idr-currency" type="text" id="cost" name="cost"
                                    value="" placeholder="Biaya" readonly />
                            </div>


                            <div class="fv-row mb-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Biaya Tambahan" />
                                <div class="position-relative w-md-300px" data-kt-dialer="true" id=""
                                    data-kt-dialer-min="0" data-kt-dialer-max="100000" data-kt-dialer-step="10000"
                                    data-kt-dialer-prefix="Rp" data-kt-dialer-currency="true">

                                    <button type="button"
                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                        data-kt-dialer-control="decrease">
                                        <i class="ki-duotone ki-minus-square fs-2"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </button>

                                    <input type="text" class="form-control form-control-solid border-0 ps-12"
                                        data-kt-dialer-control="input" placeholder="Amount" name="additional_cost"
                                        id="additional_cost" readonly value="" />

                                    <button type="button"
                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                        data-kt-dialer-control="increase">
                                        <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span
                                                class="path2"></span><span class="path3"></span></i>
                                    </button>
                                </div>

                            </div>

                            <div class="fv-row mb-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Total" />
                                <x-input class="idr-currency" type="text" id="total_cost" name="total_cost"
                                    value="" placeholder="Total " readonly />
                            </div>

                            <div class="fv-row mb-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Jumlah Bayar" />
                                <x-input class="idr-currency" type="text" id="payment_amount"
                                    name="payment_amount" value="" placeholder="Total Bayar" />
                            </div>

                            <div class="fv-row mb-4">
                                <x-label class="mb-2 fs-6 fw-semibold" value="Jumlah Kembalian" />
                                <x-input class="idr-currency" type="text" id="change_amount" name="change_amount"
                                    value="" placeholder="Jumlah Kembalian" readonly />
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
        <script src="{{ asset('assets/js/custom/apps/vehicles/index.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/wash-transactions/add.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/wash-transactions/edit.js') }}"></script>
    @endpush


</x-default-layout>
