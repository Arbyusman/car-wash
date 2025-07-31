<x-default-layout>
    <div class="card card-bordered">
        <div class="card-body">
            <div class="mb-5">
                <label for="chart-filter" class="form-label">Filter By:</label>
                <select id="chart-filter" class="form-select" style="width: 200px;">
                    <option value="last_7_days" selected>7 Hari Terakhir</option>
                    <option value="month">Bulan Ini</option>
                    <option value="year">Tahun Ini</option>
                </select>

            </div>

            <div id="wash-transactions" style="height: 350px;"></div>
        </div>
    </div>
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
