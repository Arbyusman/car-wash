<x-default-layout>
    @if ($canSeeOperationalCards)
        <div class="row g-5 g-xl-8 mb-5">
            @if ($isAdministrator)
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card card-bordered h-100">
                        <div class="card-body">
                            <div class="symbol symbol-50px mb-4">
                                <span class="symbol-label bg-light-success">
                                    {!! getIcon('chart-simple', 'fs-2 text-success') !!}
                                </span>
                            </div>
                            <div class="text-gray-700 fw-semibold fs-5 mb-2">Pendapatan Bulan Ini</div>
                            <div class="text-success fw-bold fs-2hx mb-2">{{ toRupiah($currentMonthRevenue) }}</div>
                            <div class="text-gray-500 fs-7">Current month</div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="{{ $isAdministrator ? 'col-12 col-sm-6 col-xl-3' : 'col-12 col-sm-6 col-xl-4' }}">
                <div class="card card-bordered h-100">
                    <div class="card-body">
                        <div class="symbol symbol-50px mb-4">
                            <span class="symbol-label bg-light-primary">
                                {!! getIcon('basket', 'fs-2 text-primary') !!}
                            </span>
                        </div>
                        <div class="text-gray-700 fw-semibold fs-5 mb-2">Total Transaksi</div>
                        <div class="text-primary fw-bold fs-2hx mb-2">{{ number_format($totalTransactions) }}</div>
                        <div class="text-gray-500 fs-7">Semua transaksi</div>
                    </div>
                </div>
            </div>

            <div class="{{ $isAdministrator ? 'col-12 col-sm-6 col-xl-3' : 'col-12 col-sm-6 col-xl-4' }}">
                <div class="card card-bordered h-100">
                    <div class="card-body">
                        <div class="symbol symbol-50px mb-4">
                            <span class="symbol-label bg-light-warning">
                                {!! getIcon('calendar-8', 'fs-2 text-warning') !!}
                            </span>
                        </div>
                        <div class="text-gray-700 fw-semibold fs-5 mb-2">Transaksi Hari Ini</div>
                        <div class="text-warning fw-bold fs-2hx mb-2">{{ number_format($totalTransactionsToday) }}</div>
                        <div class="text-gray-500 fs-7">Hari ini</div>
                    </div>
                </div>
            </div>

            <div class="{{ $isAdministrator ? 'col-12 col-sm-6 col-xl-3' : 'col-12 col-sm-6 col-xl-4' }}">
                <div class="card card-bordered h-100">
                    <div class="card-body">
                        <div class="symbol symbol-50px mb-4">
                            <span class="symbol-label bg-light-info">
                                {!! getIcon('people', 'fs-2 text-info') !!}
                            </span>
                        </div>
                        <div class="text-gray-700 fw-semibold fs-5 mb-2">Jumlah Pencuci</div>
                        <div class="text-info fw-bold fs-2hx mb-2">{{ number_format($totalWashers) }}</div>
                        <div class="text-gray-500 fs-7">Total pekerja terdaftar</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($canSeeOperationalCards)
        <div class="card card-bordered mb-5">
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">Kendaraan Dicuci Berdasarkan Roda</span>
                    <span class="text-muted mt-1 fw-semibold fs-7">Ringkasan jumlah kendaraan yang sudah dicuci</span>
                </h3>
            </div>
            <div class="card-body pt-2 pb-4">
                <div class="row g-5">
                    @forelse ($washedVehicleByType as $vehicleType)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="border border-gray-200 rounded p-4 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="text-dark fw-bold fs-4">{{ $vehicleType->name }}</div>
                                    <span class="badge badge-light-primary">{{ $vehicleType->size }}</span>
                                </div>
                                <div class="text-primary fw-bolder fs-2">{{ number_format($vehicleType->total_washed) }}
                                </div>
                                <div class="text-gray-500 fs-7">Kendaraan dicuci</div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-muted">Belum ada data kendaraan dicuci.</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif


    @if ($isAdministrator)
        <div class="card card-bordered">
            <div class="card-body">
                <div class="mb-5 d-flex align-items-center gap-3 flex-wrap">
                    <label for="chart-filter" class="form-label mb-0">Filter By:</label>
                    <select id="chart-filter" class="form-select" style="width: 200px;">
                        <option value="last_7_days" selected>7 Hari Terakhir</option>
                        <option value="month">Bulan Ini</option>
                        <option value="year">Tahun Ini</option>
                    </select>
                </div>

                <div id="wash-transactions" style="height: 350px;"></div>
            </div>
        </div>
    @endif
</x-default-layout>

<script>
    $(document).ready(function() {
        const element = document.getElementById('wash-transactions');

        if (!element || typeof KTUtil === 'undefined') {
            console.error("Element or KTUtil not found");
            return;
        }

        const height = parseInt(KTUtil.css(element, 'height'));
        const labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
        const borderColor = KTUtil.getCssVariableValue('--kt-gray-200');

        const baseColor = '#3e97ff';
        const lightColor = '#e1f0ff';

        const options = {
            series: [{
                name: 'Pendapatan',
                data: []
            }],
            chart: {
                fontFamily: 'inherit',
                type: 'area',
                height: height,
                toolbar: {
                    show: false
                }
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                type: 'solid',
                opacity: 0.5,
                colors: [lightColor]
            },
            stroke: {
                curve: 'smooth',
                width: 3,
                colors: [baseColor]
            },
            xaxis: {
                categories: [],
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    }
                },
                crosshairs: {
                    stroke: {
                        color: baseColor,
                        width: 1,
                        dashArray: 3
                    }
                },
                tooltip: {
                    enabled: true,
                    offsetY: 0,
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: labelColor,
                        fontSize: '12px'
                    },
                    formatter: function(val) {
                        return 'Rp ' + parseFloat(val).toLocaleString('id-ID');
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px'
                },
                y: {
                    formatter: function(val) {
                        return 'Rp ' + parseFloat(val).toLocaleString(
                            'id-ID');
                    }
                }
            },
            colors: [baseColor],
            grid: {
                borderColor: borderColor,
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            },
            markers: {
                strokeColor: baseColor,
                strokeWidth: 3
            }
        };

        const chart = new ApexCharts(element, options);
        chart.render();

        function fetchChartData(type) {
            let value;
            const now = new Date();

            if (type === 'month') {
                value = now.toISOString().slice(0, 7);
            } else if (type === 'year') {
                value = now.getFullYear();
            } else if (type === 'last_7_days') {
                value = 'last_7_days';
            }

            $.ajax({
                url: '/wash-transactions/charts',
                method: 'GET',
                data: {
                    type: type,
                    value: value
                },
                success: function(response) {
                    const categories = Object.keys(response);
                    const data = Object.values(response);

                    chart.updateOptions({
                        xaxis: {
                            categories: categories
                        },
                        series: [{
                            name: 'Pendapatan',
                            data: data
                        }],
                        yaxis: {
                            max: Math.max(...data) * 1.2,
                            labels: {
                                style: {
                                    colors: labelColor,
                                    fontSize: '12px'
                                },
                                formatter: function(val) {
                                    return 'Rp ' + parseFloat(val).toLocaleString(
                                        'id-ID');
                                }
                            }
                        }
                    });
                },
                error: function(xhr) {
                    console.error('Gagal mengambil data chart:', xhr.responseText);
                }
            });
        }

        fetchChartData('last_7_days');

        $('#chart-filter').on('change', function() {
            fetchChartData($(this).val());
        });
    });
</script>
