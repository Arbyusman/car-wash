<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .container {
            width: 100%;
            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            float: left;
            width: 80px;
            height: auto;
        }

        .title {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header -->
        <div class="header" style="text-align: center; margin-bottom: 20px;">
            <div
                style="display: flex; flex: row; align-items: center; justify-content: between; width: 100% !important;">
                <!-- Logo -->
                <!-- Title and Address -->
                <div style="width: 100%; text-align: center;">
                    <h2 style="margin: 0;text-align: center !important;">{{ setting()->name }}</h2>
                    <p style="margin: 0;text-align: center !important;">{{ setting()->address }}</p>
                </div>

            </div>

        </div>
        <h3 style="margin-top: 10px;text-align: center !important;">Laporan Transaksi</h3>


        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kasir</th>
                    <th>No Transaksi</th>
                    <th>Pekerja</th>
                    <th>Tanggal</th>
                    <th>Biaya</th>
                    <th>Biaya Tambahan</th>
                    <th>Total Bayar</th>
                    <th>Total Kembalian</th>
                    <th>Upah Pencuci</th>
                    <th>Bruto</th>
                    <th>Netto</th>
                </tr>
            </thead>
            <tbody>
                @if ($washTransactions->isEmpty())
                    <x-no-data-row colspan="13" message="Data tidak ditemukan" />
                @else
                    @php
                        $no = 1;
                        $totalVehicleCost = 0;
                        $totalAdditionalCost = 0;
                        $totalPaymentAmount = 0;
                        $totalChangeAmount = 0;
                        $totalWasherCost = 0;
                        $totalCost = 0;
                        $totalNetto = 0;
                    @endphp

                    @foreach ($washTransactions as $washTransaction)
                        @php
                            $vehicleCost = $washTransaction->washTransactionDetail?->vehicle?->cost ?? 0;
                            $additionalCost = $washTransaction->washTransactionDetail->additional_cost ?? 0;
                            $paymentAmount = $washTransaction->payment_amount ?? 0;
                            $changeAmount = $washTransaction->change_amount ?? 0;

                            $washerCost = $washTransaction->washTransactionDetail?->vehicle?->washer_cost ?? 0;
                            if ($washTransaction->washTransactionDetail->additional_cost) {
                                $washerCost += $washTransaction->washTransactionDetail->additional_cost / 2;
                            }

                            $totalTransactionCost = $washTransaction->total_cost ?? 0;

                            $netto =
                                $totalTransactionCost -
                                ($washTransaction->washTransactionDetail?->vehicle?->washer_cost ?? 0);
                            if ($washTransaction->washTransactionDetail->additional_cost) {
                                $netto -= $washTransaction->washTransactionDetail->additional_cost / 2;
                            }

                            $totalVehicleCost += $vehicleCost;
                            $totalAdditionalCost += $additionalCost;
                            $totalPaymentAmount += $paymentAmount;
                            $totalChangeAmount += $changeAmount;
                            $totalWasherCost += $washerCost;
                            $totalCost += $totalTransactionCost;
                            $totalNetto += $netto;
                        @endphp
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $washTransaction->updatedBy->name ?? $washTransaction->createdBy->name }}</td>
                            <td>{{ $washTransaction->transaction_number ?? 'N/A' }}</td>
                            <td>{{ $washTransaction->washer->name ?? 'N/A' }}</td>
                            <td>{{ $washTransaction->created_at ? \Carbon\Carbon::parse($washTransaction->created_at)->format('d-m-Y H:i:s') : 'N/A' }}
                            </td>
                            <td class="text-right">{{ toRupiah($vehicleCost) }}</td>
                            <td class="text-right">{{ toRupiah($additionalCost) }}</td>
                            <td class="text-right">{{ toRupiah($paymentAmount) }}</td>
                            <td class="text-right">{{ toRupiah($changeAmount) }}</td>

                            <td class="text-right">{{ toRupiah($washerCost) }}</td>
                            <td class="text-right">{{ toRupiah($totalTransactionCost) }}</td>
                            <td class="text-right">{{ toRupiah($netto) }}</td>
                        </tr>
                    @endforeach
                    <tr class="fw-bold bg-light">
                        <td colspan="5" class="text-center"><strong>Total</strong></td>
                        <td class="text-right">{{ toRupiah($totalVehicleCost) }}</td>
                        <td class="text-right">{{ toRupiah($totalAdditionalCost) }}</td>
                        <td class="text-right">{{ toRupiah($totalPaymentAmount) }}</td>
                        <td class="text-right">{{ toRupiah($totalChangeAmount) }}</td>
                        <td class="text-right">{{ toRupiah($totalWasherCost) }}</td>
                        <td class="text-right">{{ toRupiah($totalCost) }}</td>
                        <td class="text-right">{{ toRupiah($totalNetto) }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            <p>Dicetak pada: {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>
    </div>

</body>

</html>
