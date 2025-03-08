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
            <div style="display: flex; align-items: center; justify-content: center; width: 100%;">
                <!-- Logo -->
                <div style="width: 20%; text-align: center;">
                    <img class="logo" src="{{ public_path('storage/images/' . setting()->small_icon) }}" alt="Logo"
                        style="max-height: 80px;">
                </div>

                <!-- Title and Address -->
                <div style="width: 90%; text-align: center;">
                    <h2 style="margin: 0;">{{ setting()->name }}</h2>
                    <p style="margin: 0;">{{ setting()->address }}</p>
                    <h3 style="margin-top: 10px; text-decoration: underline;">Laporan Transaksi</h3>
                </div>

                <!-- Right Spacing -->
                <div style="width: 20%;"></div>
            </div>

        </div>


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
                    @php $no = 1; @endphp
                    @foreach ($washTransactions as $washTransaction)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $washTransaction->updatedBy->name ?? $washTransaction->createdBy->name }}</td>
                            <td>{{ $washTransaction->transaction_number ?? 'N/A' }}</td>
                            <td>{{ $washTransaction->washer->name ?? 'N/A' }}</td>
                            <td>{{ $washTransaction->created_at ? \Carbon\Carbon::parse($washTransaction->created_at)->format('d-m-Y H:i:s') : 'N/A' }}
                            </td>
                            <td class="text-right">
                                {{ toRupiah($washTransaction->washTransactionDetail?->vehicle?->cost ?? 0) }}</td>
                            <td class="text-right">
                                {{ toRupiah($washTransaction->washTransactionDetail->additional_cost ?? 0) }}</td>
                            <td class="text-right">{{ toRupiah($washTransaction->payment_amount ?? 0) }}</td>
                            <td class="text-right">{{ toRupiah($washTransaction->change_amount ?? 0) }}</td>
                            <td class="text-right">
                                {{ toRupiah($washTransaction->washTransactionDetail?->vehicle?->washer_cost ?? 0) }}
                            </td>
                            <td class="text-right">{{ toRupiah($washTransaction->total_cost ?? 0) }}</td>
                            <td class="text-right">
                                @php
                                    $netto =
                                        $washTransaction->total_cost -
                                        ($washTransaction->washTransactionDetail?->vehicle?->washer_cost ?? 0);
                                @endphp
                                {{ toRupiah($netto) }}
                            </td>
                        </tr>
                    @endforeach
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
