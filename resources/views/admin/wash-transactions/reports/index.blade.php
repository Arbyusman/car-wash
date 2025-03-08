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

                        <a title="Report Transaksi" type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#report-transaksi">
                            <i class="ki-duotone ki-document fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Report
                        </a>

                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-row-bordered gy-5 gs-7">
                        <thead>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th style="width: 2%">No</th>
                                <th style="width: 8%">Kasir</th>
                                <th style="width: 8%">No Transaksi</th>
                                <th style="width: 8%">Pekerja</th>
                                <th style="width: 8%">Tanggal</th>
                                <th style="width: 8%">Biaya</th>
                                <th style="width: 8%">Biaya Tambahan</th>
                                <th style="width: 8%">Total Bayar</th>
                                <th style="width: 8%">Total Kembalian</th>
                                <th style="width: 8%">Upah Pencuci</th>
                                <th style="width: 8%">Bruto</th>
                                <th style="width: 8%">Netto</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php
                                $no = 1;
                            @endphp

                            @if ($washTransactions->isEmpty())
                                <x-no-data-row colspan="11" message="Data tidak ditemukan" />
                            @else
                                @foreach ($washTransactions as $washTransaction)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $washTransaction->updatedBy ? $washTransaction->updatedBy->name : $washTransaction->createdBy->name }}
                                        </td>
                                        <td>{{ $washTransaction->transaction_number ?? 'N/A' }}</td>
                                        <td>{{ $washTransaction->washer->name ?? 'N/A' }}</td>
                                        <td>{{ $washTransaction->created_at ? \Carbon\Carbon::parse($washTransaction->created_at)->locale('id')->translatedFormat('l, d F Y H:i') . ' WITA' : 'N/A' }}
                                        </td>

                                        <td>{{ toRupiah($washTransaction->washTransactionDetail?->vehicle?->cost ?? 0) }}
                                        </td>
                                        <td>{{ toRupiah($washTransaction->washTransactionDetail->additional_cost ?? 0) }}
                                        </td>
                                        <td>{{ toRupiah($washTransaction->payment_amount ?? 0) }}</td>
                                        <td>{{ toRupiah($washTransaction->change_amount ?? 0) }}</td>
                                        <td>{{ toRupiah($washTransaction->total_cost ?? 0) }}</td>
                                        <td>{{ toRupiah($washTransaction->washTransactionDetail?->vehicle?->washer_cost ?? 0) }}
                                        </td>
                                        <td>
                                            @php
                                                $netto =
                                                    $washTransaction->total_cost -
                                                    $washTransaction->washTransactionDetail?->vehicle?->washer_cost;
                                            @endphp
                                            {{ toRupiah($netto) }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>

                    {{ $washTransactions->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-modal id="report-transaksi" class="mw-650px">
        <x-slot name="title">Report Transaksi</x-slot>
        <x-slot name="body">
            <form action="{{ route('wash-transaction-reports.report') }}" method="POST">
                @csrf
                @method("get")

                <div class="fv-row mb-8">
                    <x-label class="mb-2 fs-6 fw-semibold" value="Kasir" :required="false" />
                    <select class="form-select" data-control="select2" data-dropdown-parent="#report-transaksi"
                        name="cashier_id">
                        <option value="" readonly>Pilih Kasir</option>
                        @foreach ($cashiers as $cashier)
                            <option value="{{ $cashier->id }}">
                                {{ $cashier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="fv-row mb-8">
                    <x-label class="mb-2 fs-6 fw-semibold" value="Pekerja" :required="false" />
                    <select class="form-select" data-control="select2" data-dropdown-parent="#report-transaksi"
                        name="washer_id">
                        <option value="" readonly>Pilih Pekerja</option>
                        @foreach ($washers as $washer)
                            <option value="{{ $washer->id }}">
                                {{ $washer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="fv-row mb-8">
                    <x-label class="mb-2 fs-6 fw-semibold" value="Kendaraan" :required="false" />
                    <select class="form-select" data-control="select2" data-dropdown-parent="#report-transaksi"
                        name="vehicle_id" id="vehicle_id">
                        <option value="" readonly>Pilih Kendaraan</option>
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" data-cost="{{ $vehicle->cost }}">
                                {{ $vehicle->name }}</option>
                        @endforeach
                    </select>

                </div>



                <div class="fv-row mb-8">
                    <x-label class="mb-2 fs-6 fw-semibold" value="Pilih Rentang Waktu" :required="false" />
                    <x-input name="date-range" class="form-control form-control-solid" placeholder="Pick date rage"
                        id="kt_daterangepicker_4" placeholder="Pilih Rentang Waktu" />
                </div>

                <div class="modal-footer d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Download</button>
                </div>
            </form>
        </x-slot>
    </x-modal>


    @push('scripts')
        <script>
            var start = moment().subtract(29, "days");
            var end = moment();

            function cb(start, end) {
                $("#kt_daterangepicker_4").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
            }

            $("#kt_daterangepicker_4").daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    "Today": [moment(), moment()],
                    "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                    "Last 7 Days": [moment().subtract(6, "days"), moment()],
                    "Last 30 Days": [moment().subtract(29, "days"), moment()],
                    "This Month": [moment().startOf("month"), moment().endOf("month")],
                    "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1,
                        "month").endOf(
                        "month")]
                }
            }, cb);

            cb(start, end);
        </script>
    @endpush

</x-default-layout>
