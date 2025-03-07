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
                                <th style="width: 5%">NO</th>
                                <th style="width: 20%">No Transaksi</th>
                                <th style="width: 15%">Pekerja</th>
                                <th style="width: 15%">Tanggal</th>
                                <th style="width: 10%">Biaya</th>
                                <th style="width: 10%">Biaya Tambahan</th>
                                <th style="width: 10%">Total Biaya</th>
                                <th style="width: 20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = 1;
                            @endphp

                            @if ($washTransactions->isEmpty())
                                <x-no-data-row colspan="4" message="Data tidak ditemukan" />
                            @else
                                @foreach ($washTransactions as $washTransaction)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $washTransaction->transaction_number ?? 'N/A' }}</td>
                                        <td>{{ $washTransaction->washer->name ?? 'N/A' }}</td>
                                        <td>{{ $washTransaction->created_at ?? 'N/A' }}</td>
                                        <td>{{ toRupiah($washTransaction->washTransactionDetail?->vehicle?->cost ?? 0) }}</td>
                                        <td>{{ toRupiah($washTransaction->washTransactionDetail->additional_cost ?? 0) }}</td>
                                        <td>{{ toRupiah($washTransaction->total_cost ?? 0) }}</td>
                                        <td>
                                            <button title="Ubah Transaksi" type="button"
                                                class="btn btn-icon btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#update-wash-transaction{{ $washTransaction->id }}">
                                                <i class="fas far fa-edit"></i>
                                            </button>

                                            <x-modal id="update-wash-transaction{{ $washTransaction->id }}" class="mw-650px">
                                                <x-slot name="title">Ubah Data Transaksi</x-slot>
                                                <x-slot name="body">
                                                    <form
                                                        action="{{ route('wash-transactions.update', ['wash_transaction' => $washTransaction]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="fv-row my-4">
                                                            <x-label class="mb-2 fs-6 fw-semibold"
                                                                value="Tipe Transaksi" />
                                                            <select class="form-select" name="vehicle_type_id" required>
                                                                <option value="" readonly>Pilih Tipe Transaksi
                                                                </option>
                                                                @foreach ($vehicles as $vehicle)
                                                                    <option value="{{ $vehicle->id }}"
                                                                        {{-- {{ $washTransaction->vehicle_type_id == $vehicle->id ? 'selected' : '' }} --}}>
                                                                        {{ $vehicle->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="fv-row mb-4">
                                                            <x-label class="mb-2 fs-6 fw-semibold" value="Biaya" />
                                                            <x-input class="idr-currency" type="text" id="edit_cost"
                                                                name="cost" value="{{ $washTransaction->cost }}"
                                                                placeholder="Biaya" />

                                                        </div>

                                                        <div class="fv-row mb-4">
                                                            <x-label class="mb-2 fs-6 fw-semibold"
                                                                value="Upah Pencuci" />
                                                            <x-input class="idr-currency" type="text"
                                                                id="edit_washer_cost" name="washer_cost"
                                                                value="{{ $washTransaction->washer_cost }}"
                                                                placeholder="Upah Pencuci" />

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


                                            <button title="Hapus Transaksi" type="button"
                                                class="btn btn-icon btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete-wash-transaction{{ $washTransaction->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>

                                            <div class="modal fade" id="delete-wash-transaction{{ $washTransaction->id }}"
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
                                                                    <h2>Menghapus Data Transaksi</h2>
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
                                    data-dropdown-parent="#add-vehicle" name="vehicle_id" required>
                                    <option value="" disabled>Pilih Kendaraan</option>
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
                                    <option value="" disabled>Pilih Pekerja</option>
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

                                    <input type="text"
                                        class="form-control form-control-solid border-0 ps-12"
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
                                <x-label class="mb-2 fs-6 fw-semibold" value="Biaya" />
                                <x-input class="idr-currency" type="text" id="total_cost" name="total_cost"
                                    value="" placeholder="Total Biaya" readonly />
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
        <script>
            $(document).ready(function() {
                $('#cost').closest('.fv-row').hide();
                $('#total_cost').closest('.fv-row').hide();
                $('#additional_cost').closest('.fv-row').hide();

                $('select[name="vehicle_id"]').on('change', function() {
                    var selectedCost = $(this).find(':selected').data('cost') || 0;
                    $('#cost')
                        .val(formatRupiah(selectedCost))
                        .prop('readonly', true)
                        .closest('.fv-row').show();

                    $('#additional_cost')
                        .closest('.fv-row').show();

                    calculateTotal();
                });

                $('[data-kt-dialer-control="input"]').on('change keyup input', function() {
                    calculateTotal();
                });

                function formatRupiah(amount) {
                    let number = parseFloat(amount) || 0;
                    let numberString = number.toFixed(2);
                    let split = numberString.split(".");
                    let integerPart = split[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");

                    return 'Rp ' + integerPart;
                }

                function parseCurrency(value) {
                    if (typeof value === "number") return value;
                    if (!value || value === "") return 0;

                    return parseFloat(value.toString().replace(/[^\d,]/g, "").replace(",", ".")) || 0;
                }

                function calculateTotal() {
                    var cost = parseCurrency($('select[name="vehicle_id"]').find(':selected').data('cost'));
                    var additionalCost = parseCurrency($('[data-kt-dialer-control="input"]').val());

                    var total = cost + additionalCost;

                    $('#total_cost')
                        .val(formatRupiah(total))
                        .prop('readonly', true)
                        .closest('.fv-row').show();
                }
            });
        </script>
    @endpush


</x-default-layout>
